<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = array('nom', 'prenom', 'telephone', 'adresse');

    public static $rules = array(
        'nom' => 'required|min:2',
        'prenom' => 'required|min:3',
        'telephone' => 'required|min:9',
        'adresse' => 'required|min:3'
    );
}