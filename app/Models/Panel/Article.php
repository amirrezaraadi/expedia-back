<?php

namespace App\Models\Panel;

use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'sub_title',
        'slug',
        'featuring_image',
        'tags',
        'star',
        'status',
        'view_count',
        'content',
        'image',
        'user_id',
    ];
    const STATUS_PENDING = 'pending';
    const STATUS_SUCCESS = 'success';
    const STATUS_REJECT = 'reject';

    public static $status = [self::STATUS_SUCCESS, self::STATUS_REJECT, self::STATUS_PENDING];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title', 'slug']
            ]
        ];
    }

    protected $casts = [
      'tags' => 'array'
    ];
    protected $appends = ['image_original' ];

    public function getImageOriginalAttribute()
    {
        return asset('images/articles/' . $this->image);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_article');
    }


}
