<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\Array_;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $password
 * @property string $avatar_url
 * @property object $permissions
 * @property string|null $last_login_attempt_ip
 * @property boolean|null $last_login_attempt_successful
 * @property Carbon|null $last_login_attempt_at
 * @property string|null $remember_token
 * @mixin \Eloquent
 */
class User extends Model implements Authenticatable
{
    public $timestamps = false;
    
    public $casts = [
      'permissions' => 'object'
    ];
    
    public $dates = [
        'last_login_attempt_at'
    ];
    
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
    
    /**
     * @return int
     */
    public function getAuthIdentifier(): int
    {
        return $this->id;
    }
    
    /**
     * @return string
     */
    public function getAuthIdentifierName(): string
    {
        return 'id';
    }
    
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    
    /**
     * @param  string  $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    
    /**
     * @return string
     */
    public function getAuthPassword(): string
    {
        return $this->password;
    }
    
    /**
     * @param  string  $password
     */
    public function setAuthPassword(string $password): void
    {
        $this->password = bcrypt($password);
    }
    
    /**
     * @return string
     */
    public function getAvatarUrl(): string
    {
        return $this->avatar_url;
    }
    
    /**
     * @param  string  $avatar_url
     */
    public function setAvatarUrl(string $avatar_url): void
    {
        $this->avatar_url = $avatar_url;
    }
    
    /**
     * @return object
     */
    public function getPermissions(): object
    {
        return $this->permissions;
    }
    
    /**
     * @param  object  $permissions
     */
    public function setPermissions(object $permissions): void
    {
        $this->permissions = $permissions;
    }
    
    /**
     * @return string|null
     */
    public function getLastLoginAttemptIp(): ?string
    {
        return $this->last_login_attempt_ip;
    }
    
    /**
     * @return boolean|null
     */
    public function isLastLoginAttemptSuccessful(): ?bool
    {
        return $this->last_login_attempt_successful;
    }
    
    /**
     * @return Carbon|null
     */
    public function getLastLoginAttemptAt(): ?Carbon
    {
        return $this->last_login_attempt_at;
    }
    
    /**
     * @param  string  $ip
     * @param  boolean $attemptSuccessful
     */
    public function setLastLoginInfo($ip, $attemptSuccessful): void
    {
        $this->last_login_attempt_ip = $ip;
        $this->last_login_attempt_successful = $attemptSuccessful;
        $this->last_login_attempt_at = now();
    }
    
    /**
     * @return string|null
     */
    public function getRememberToken(): ?string
    {
        return $this->remember_token;
    }
    
    /**
     * @param  string|null  $remember_token
     */
    public function setRememberToken($remember_token): void
    {
        $this->remember_token = $remember_token;
    }
    
    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName(): string
    {
        return 'remember_token';
    }
    
    public static function create($name, $password, $permissions) {
        $user = new User();
        
        $user->name = $name;
        $user->password = bcrypt($password);
        $user->avatar_url = asset('images/default-avatar.png');
        
        if (is_array($permissions)) {
            $permissions = (object) $permissions;
        }
        
        $user->permissions = $permissions;
        $user->save();
        
        // TODO log to db
    }
    
    public function updatePermissions($permissions)
    {
    
        if (is_array($permissions)) {
            $permissions = (object) $permissions;
        }
        
        $this->permissions = $permissions;
        $this->save();
        
        // TODO log to db
    }
    
    public static function remove($id) {
        $user = User::findOrFail($id);
        
        
        $user->delete();
        
        // TODO log to db
    }
    
    public static function changePassword($id, $password) {
        $user = User::findOrFail($id);
        
        $user->password = bcrypt($password);
        $user->save();
        
        // TODO log to db
    }
}
