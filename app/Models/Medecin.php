<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medecin extends Model
{
    use HasFactory;

    protected $fillable = array('nom', 'prenom', 'telephone');

    public static $rules = array(
        'nom' => 'required|min:2',
        'prenom' => 'required|min:3',
        'telephone' => 'required|min:9'
    );

    //un medecin peut avoir plusieurs RV
    public function rendezvous(){
        return $this->hasMany('App\Rendezvous');
    }
}