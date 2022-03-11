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
}
