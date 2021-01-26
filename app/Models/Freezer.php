<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freezer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'capacity',
        'obs',
        'cant_racks',
        'cant_box',
        'cap_box',
    ];

    public function locations()
    {
        return $this->hasMany('App\Models\Location');
    }

}
