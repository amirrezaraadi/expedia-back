<?php

namespace App\Models\Panel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ads extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'advertising',
        'type_advertising',
        "expire_at",
        'opening_limit',
        'user_id'
    ];
    const ADVERTISING_LANDING_PAGE_RIGHT = 'landing page right';
    const ADVERTISING_LANDING_PAGE_LEFT = 'landing page left';
    const ADVERTISING_ARTICLE_PAGE = 'article page';
    public static $advertising = [
        self::ADVERTISING_ARTICLE_PAGE,
        self::ADVERTISING_LANDING_PAGE_LEFT,
        self::ADVERTISING_LANDING_PAGE_RIGHT
    ];

    const TYPE_ADVERTISING_NEW_TAB = 'new tab';
    const TYPE_ADVERTISING_POP_UP = 'pop up';
    const TYPE_ADVERTISING_BANNER = 'banner';
    const TYPE_ADVERTISING_LINK = 'link';
    public static $typees = [
        self::TYPE_ADVERTISING_NEW_TAB,
        self::TYPE_ADVERTISING_POP_UP,
        self::TYPE_ADVERTISING_BANNER,
        self::TYPE_ADVERTISING_LINK,
    ];

    const OPENING_LIMIT_NONE = 'none';
    const OPENING_LIMIT_DAY_ONE = 'day one';
    const OPENING_LIMIT_DAY_TWO = 'day two';
    const OPENING_LIMIT_DAY_THREE = 'day three';
    const OPENING_LIMIT_DAY_FOUR = 'day four';
    const OPENING_LIMIT_DAY_FIVE = 'day five ';
    const OPENING_LIMIT_DAY_SIX = 'day six';
    const OPENING_LIMIT_DAY_SEVEN = 'day seven';
    const OPENING_LIMIT_DAY_EIGHT = 'day eight';
    const OPENING_LIMIT_DAY_NINE = 'day nine';
    public static $opening_limit = [
        self::OPENING_LIMIT_NONE,
        self::OPENING_LIMIT_DAY_ONE,
        self::OPENING_LIMIT_DAY_TWO,
        self::OPENING_LIMIT_DAY_THREE,
        self::OPENING_LIMIT_DAY_FOUR,
        self::OPENING_LIMIT_DAY_FIVE,
        self::OPENING_LIMIT_DAY_SIX,
        self::OPENING_LIMIT_DAY_SEVEN,
        self::OPENING_LIMIT_DAY_EIGHT,
        self::OPENING_LIMIT_DAY_NINE,
    ];


}
