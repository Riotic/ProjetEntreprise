<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Synthstuc extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
        'photoProfil',
        'CV',
        'user_id',
        'client_id',
        'prenom',
        'nom',
        'metier',
        'adresse',
        'telephone',
        'email',
        'website',
        'instagram',
        'twitter',
        'facebook',
        'linkedin',
        'reseau_autre',
        'formations',
        'experiences',
        'departement',
        'synthese',
        'type'
    ];
}
