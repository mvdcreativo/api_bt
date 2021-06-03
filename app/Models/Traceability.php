<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traceability extends Model
{
    use HasFactory;
    protected $fillable = ['user_name', 'obs','body','sample_id','stage_id', 'tube_id'];


    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }


    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    
    public function tube()
    {
        return $this->belongsTo(Tube::class);
    }

    /////////////////////////////
        ///SCOPES
    /////////////////////////////

    public function scopeFilter($query, $filter)
    {
        if($filter)
            return $query
                ->orWhere('user_name', "LIKE", '%'.$filter.'%')
                ->orWhere('obs', "LIKE", '%'.$filter.'%')
                ->orWhere('created_at', "LIKE", '%'.$filter.'%');
    }
}
