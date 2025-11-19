<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'quantity', 'description', 'incoming_id'];

    
   // Item milik satu Incoming
    public function incoming()
    {
        return $this->belongsTo(Incoming::class);
    }

    // Item bisa punya banyak barang keluar
    public function outgoings()
    {
        return $this->hasMany(Outgoing::class);
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'item_id');
    }

}
