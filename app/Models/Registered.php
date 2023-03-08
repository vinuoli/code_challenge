<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use App\Models\Expert;

class Registered extends Model
{
    use HasFactory,HasApiTokens;
    protected $connection = 'mysql';
    protected $table = 'registereds';
    protected $primaryKey = 'registered_id';

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'net_income',
        'requested_amount',
        'registration',
        'initial_communication_time',
        'end_communication_time'
    ];

    protected $hidden = [
        'remember_token',
    ];
    
    public function experts()
    {
        return $this->belongsTo('App\Models\Expert','id_expert_assigned', 'experts_id');
    }
    
}
