<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = ['customer_id', 'service_id', 'invoice_id', 'quantity', 'made'];

    public $timestamps = false;

    protected $casts = ['made' => 'array'];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function service()
    {
        return $this->belongsTo('App\ProductService', 'service_id');
    }

    public function getStatusAttribute()
    {
        $made = count($this->made);

        $contrated = $this->quantity;

        return $made . __(' made of ') . $contrated . __(' contrated.');
    }
}
