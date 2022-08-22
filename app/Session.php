<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = ['customer_id', 'service_id', 'invoice_id', 'quantity', 'made'];

    public $timestamps = false;

    protected $casts = ['made' => 'array'];
}
