<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $fillable = ['customer_id', 'user_id', 'photo', 'photos', 'age', 'amount', 'anamnesis', 'datetime', 'status'];

    public $timestamps = false;

    protected $casts = ['anamnesis' => 'array'];
}
