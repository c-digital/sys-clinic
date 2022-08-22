<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    protected $fillable = ['code', 'description'];

    public $timestamps = false;
}
