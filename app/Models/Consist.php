<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consist extends Model
{
    use HasFactory;
    protected $guarded=['id','created_at','updated_at'];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
