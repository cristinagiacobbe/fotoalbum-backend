<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'title', 'description', 'image', 'in_evidence'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
