<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Media extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image_path'
    ];

    public function provider(): HasOne
    {
        return $this->hasOne(
            Provider::class,
            'id',
            'provider_id'
        );
    }
}
