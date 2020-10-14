<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Device
 * @mixin \Eloquent
 */
class Device extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function digitized_cards()
    {
        return $this->hasMany(DigitizedCard::class, 'device_id');
    }
}
