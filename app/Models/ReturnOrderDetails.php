<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnOrderDetails extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function ReturnOrder()
    {
        return $this->belongsTo(ReturnOrder::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

}
