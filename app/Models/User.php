<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $password
 * @property string $avatar_url
 * @property object $permissions
 * @property string|null $last_login_attempt_ip
 * @property int|null $last_login_attempt_successful
 * @property Carbon|null $last_login_attempt_at
 */
class User extends Authenticatable
{

    public $timestamps = false;

    protected $casts = [
        'permissions' => 'object'
    ];

    protected $dates = [
        'last_login_attempt_at'
    ];

    public $guarded = [];
    
    public function getId(): int
    {
        return $this->id;
    }
    
    public function getName(): string
    {
        return $this->name;
    }
    
    public function setPassword(string $password): void
    {
        $this->password = bcrypt($password);
    }
    
    public function getPermissions(): object
    {
        return $this->permissions;
    }
    
    public function getAvatarUrl(): string
    {
        return $this->avatar_url;
    }
    
    public function setAvatarUrl(string $avatar_url): void
    {
        $this->avatar_url = $avatar_url;
    }
    
    public function getLastLoginAttemptIp(): ?string
    {
        return $this->last_login_attempt_ip;
    }
    
    public function isLastLoginAttemptSuccessful(): ?int
    {
        return $this->last_login_attempt_successful;
    }
    
    public function getLastLoginAttemptAt(): ?Carbon
    {
        return $this->last_login_attempt_at;
    }
    
    public function setLastLoginInfo(string $ip, bool $status): void
    {
        $this->last_login_attempt_ip = $ip;
        $this->last_login_attempt_successful = $status;
        $this->last_login_attempt_at = now();
    }
}
