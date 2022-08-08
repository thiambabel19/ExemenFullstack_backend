<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rv extends Model
{
    use HasFactory;

    protected $fillable = array('medecins_id','user_id', 'libelle', 'date', 'patients_id');

    public static $rules = array(
        'medecins_id' => 'required|integer',
        'user_id' => 'required|bigInteger',
        'libelle' => 'required|min:20',
        'date' => 'required|min:9',
        'patients_id' => 'required|integer'
    );

    public function rendezvous(){
        return $this->belongsTo('App\Medecin');
    }

    public function medecins(){
        return $this->belongsTo('App\Medecin');
    }

    public function users(){
        return $this->belongsTo('App\User');
    }
}
