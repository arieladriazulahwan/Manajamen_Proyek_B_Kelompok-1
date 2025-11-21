<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'warehouse_name',
        'warehouse_address',
        'warehouse_phone',
        'admin_email',
        'logo_path'
    ];
}
