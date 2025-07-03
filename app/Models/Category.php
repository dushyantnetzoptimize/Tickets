<?php

namespace App\Models;

use Illuminate\Support\Str;
use Coderflex\LaravelTicket\Models\Category as TicketCategory;

class Category extends TicketCategory
{
    protected $casts = [
        'is_visible' => 'boolean',
    ];

    protected $fillable = ['name', 'is_visible', 'parent_id'];

    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function children() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function (Category $category) {
            $category->slug = Str::slug($category->name);
        });
    }
}