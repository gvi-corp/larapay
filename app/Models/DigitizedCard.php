<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DigitizedCard
 * @mixin \Eloquent
 */
class DigitizedCard extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function pan(){
        return $this->belongsTo(PAN::class);
    }

    public function device(){
        return $this->belongsTo(Device::class);
    }
}
