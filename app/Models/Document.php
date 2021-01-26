<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_file',
        'url_file',
    ];

    public function patients()
    {
        return $this->belongsToMany('App\Models\Patient');
    }


}
