<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    // protected $fillable = ['name', 'edulevel_id'];
    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];
    
    public function edulevel()
    {
        return $this->belongsTo('App\Models\Edulevel');
    }
}
