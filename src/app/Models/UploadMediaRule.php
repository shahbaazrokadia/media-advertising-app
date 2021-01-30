<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UploadMediaRule extends Model
{
    use HasFactory;

    public function provider(): HasOne
    {
        return $this->hasOne(
            Provider::class,
            'id',
            'provider_id'
        );
    }
}
