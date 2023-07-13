<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WishlistItem extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image_path'];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
