<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'experts';
    protected $primaryKey = 'experts_id';

    protected $fillable = [
        'full_name',
        'total_active_cases',
        'activo'
    ];
    
    
    public function registered()
    {
        return $this->hasMany('App\Models\Registered','id_expert_assigned', 'experts_id');
    }
    

}
