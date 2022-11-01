<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Subscription extends Model
{
    use HasFactory;

    public function share(): hasOne
    {
        return $this->hasOne(Share::class, 'id', 'share_id');
    }
}
