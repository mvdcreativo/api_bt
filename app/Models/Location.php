<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'description',
        'freezer_id',
    ];

    public function freezer()
    {
        return $this->belongsTo('App\Models\Freezer');
    }
}
