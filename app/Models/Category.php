<?php

namespace App\Models;

use Illuminate\Support\Str;
use Coderflex\LaravelTicket\Models\Category as TicketCategory;

class Category extends TicketCategory
{
    protected $casts = [
        'is_visible' => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function (Category $category) {
            $category->slug = Str::slug($category->name);
        });
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}