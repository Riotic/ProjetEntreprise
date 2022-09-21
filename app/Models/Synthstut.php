<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Synthstut extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
        'photoProfil',
        'photoCouverture',
        'photoCarrousel1',
        'photoCarrousel2',
        'photoCarrousel3',
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
        'linkedin',
        'facebook',
        'youtube',
        'horaire',
        'motsClefs',
        'departement',
        'citation',
        'synthese',
        'type',
        'adresseBis',
    ];
}
