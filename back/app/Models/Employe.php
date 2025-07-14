<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    
    use HasFactory;
    
    protected $table = 'employes';

    // Clé primaire personnalisée
    protected $primaryKey = 'numEmp';

    // La clé primaire n'est pas un entier auto-incrémenté
    public $incrementing = false;

    // Le type de la clé primaire est string
    protected $keyType = 'string';

    protected $fillable = ['numEmp', 'nom', 'salaire'];
}
