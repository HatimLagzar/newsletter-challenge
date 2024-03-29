<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    public const ID_COLUMN = 'id';
    public const USER_ID_COLUMN = 'user_id';
    public const WEBSITE_ID_COLUMN = 'website_id';
    public const CREATED_AT_COLUMN = 'created_at';
    public const UPDATED_AT_COLUMN = 'updated_at';

    protected $fillable = [
        self::USER_ID_COLUMN,
        self::WEBSITE_ID_COLUMN
    ];

    public function getId(): int
    {
        return $this->getAttribute(self::ID_COLUMN);
    }

    public function getUserId(): int
    {
        return $this->getAttribute(self::USER_ID_COLUMN);
    }

    public function getWebsiteId(): int
    {
        return $this->getAttribute(self::WEBSITE_ID_COLUMN);
    }

    public function user(): User
    {
        return $this->hasOne(User::class, User::ID_COLUMN, self::USER_ID_COLUMN)->first();
    }

    public function website(): Website
    {
        return $this->hasOne(Website::class, Website::ID_COLUMN, self::WEBSITE_ID_COLUMN)->first();
    }
}
