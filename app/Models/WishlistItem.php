<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WishlistItem extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image_path', 'user_id'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return 'https://placehold.co' . $this->image_path;
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
