<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplaceOrderDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public function item()
    {
        return $this->belongsTo(Item::class);
    }


    public function ReplaceOrder()
    {
        return $this->belongsTo(ReplaceOrder::class);

    }
}
