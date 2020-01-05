<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

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
 * @property \Illuminate\Support\Carbon|null $last_login_attempt_at
 * @property string|null $remember_token
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAvatarUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastLoginAttemptAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastLoginAttemptIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastLoginAttemptSuccessful($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePermissions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{

    public $timestamps = false;

    public $casts = [
        'permissions' => 'object'
    ];

    public $dates = [
        'last_login_attempt_at'
    ];

    public $guarded = [];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = bcrypt($password);
    }

    /**
     * @return object
     */
    public function getPermissions(): object
    {
        return $this->permissions;
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
     * @param  object  $permissions
     */
    public function setPermissions(object $permissions): void
    {
        if (is_array($permissions)) {
            $permissions = (object) $permissions;
        }

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
     * @return int|null
     */
    public function isLastLoginAttemptSuccessful(): ?int
    {
        return $this->last_login_attempt_successful;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getLastLoginAttemptAt(): ?\Illuminate\Support\Carbon
    {
        return $this->last_login_attempt_at;
    }

    /**
     * @param  string  $ip
     * @param  bool  $status
     */
    public function setLastLoginInfo(string $ip, bool $status): void
    {
        $this->last_login_attempt_ip = $ip;
        $this->last_login_attempt_successful = $status;
        $this->last_login_attempt_at = now();
    }
}
