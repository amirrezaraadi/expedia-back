<?php

namespace App\Models\Panel;

use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory , Sluggable;
    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'user_id',
    ];

    protected $hidden = [
        'user_id',

        'created_at',
        'pivot'
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title', 'slug']
            ]
        ];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class , 'parent_id');
    }

    public function child(): HasMany
    {
        return $this->hasMany(self::class , 'parent_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function articles():BelongsToMany
    {
        return $this->belongsToMany(Article::class , 'category_article');
    }
}
