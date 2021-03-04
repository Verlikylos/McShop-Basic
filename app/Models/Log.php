<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Log
 *
 * @property int $id
 * @property string $category
 * @property string $color
 * @property string $details
 * @property int|null $user_id
 * @property Carbon $date;
 */
class Log extends Model
{
    public $timestamps = false;
    
    protected $dates = [
        'date'
    ];
    
    protected $guarded = [];
    
    public function getId(): int
    {
        return $this->id;
    }
    
    public function getCategory(): string
    {
        return $this->category;
    }
    
    public function getColor()
    {
        return $this->color;
    }
    
    public function getDetails(): string
    {
        return $this->details;
    }
    
    public function getDate(): Carbon
    {
        return $this->date;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function getUser(): User
    {
        return $this->user;
    }
    
}
