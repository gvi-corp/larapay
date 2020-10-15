<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PAN
 * @package App\Models
 * @mixin \Eloquent
 */

class PAN extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pans';

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function digitized_cards()
    {
        return $this->hasMany(DigitizedCard::class, 'pan_id');
    }

    public function show(){

    }
}
