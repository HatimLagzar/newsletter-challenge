<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    public const ID_COLUMN = 'id';
    public const URL_COLUMN = 'url';
    public const CREATED_AT_COLUMN = 'created_at';
    public const UPDATED_AT_COLUMN = 'updated_at';

    public function getId(): int
    {
        return $this->getAttribute(self::ID_COLUMN);
    }

    /**
     * @return Collection|Post[]
     */
    public function posts(): Collection
    {
        return $this->hasMany(Post::class, 'website_id', 'id')->get();
    }
}
