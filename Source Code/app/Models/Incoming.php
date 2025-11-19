<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incoming extends Model
{
    protected $fillable = ['item_name', 'quantity', 'description'];
    
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

     // Relasi ke Item (1 Incoming punya banyak Item)
    public function items()
    {
        return $this->hasMany(Item::class);
    }

}
