<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Page
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $icon
 * @property string $type
 * @property string $content
 * @property bool $active
 * @property int $sort_id
 */
class Page extends Model
{
    public $timestamps = false;
    
    protected $casts = [
        'active' => 'boolean',
        'used_by' => 'array'
    ];
    
    protected $guarded = [];
    
    public function getId(): int
    {
        return $this->id;
    }
    
    public function getName(): string
    {
        return $this->name;
    }
    
    public function getSlug(): string
    {
        return $this->slug;
    }
    
    public function getIcon(): ?string
    {
        return $this->icon;
    }
    
    public function getType(): string
    {
        return $this->type;
    }
    
    public function getContent(): string
    {
        return $this->content;
    }
    
    public function getFormattedContent(): string
    {
        return app(\Parsedown::class)->setSafeMode(true)->text($this->content);
    }
    
    public function isActive(): bool
    {
        return $this->active;
    }
    
    public function getSortId(): int
    {
        return $this->sort_id;
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function checkI()
    {
    
    }
}
