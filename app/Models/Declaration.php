<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Declaration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'type', 
        'description', 
        'autre_type', 
        'urgence',
        'departement_id', 
        'commune_id', 
        'arrondissement_id', 
        'quartier', 
        'rue', 
        'maison',
        'latitude', 
        'longitude', 
        'statut',
        'lien_localisation'
    ];

    protected $casts = [
        'urgence' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relation avec l'utilisateur qui a créé la déclaration
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec les utilisateurs qui suivent cette déclaration
    public function followers()
    {
        return $this->belongsToMany(User::class, 'declaration_user')
                    ->withTimestamps();
    }

    // Relation avec le département
    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    // Relation avec la commune
    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

    // Relation avec l'arrondissement
    public function arrondissement()
    {
        return $this->belongsTo(Arrondissement::class);
    }

    // Relation avec les médias (images/vidéos)
    public function media()
    {
        return $this->hasMany(Media::class);
    }

    // Vérifie si un utilisateur suit cette déclaration
    public function isFollowedBy(User $user)
    {
        return $this->followers()->where('user_id', $user->id)->exists();
    }

    // Scope pour les déclarations urgentes
    public function scopeUrgent($query)
    {
        return $query->where('urgence', true);
    }

    // Scope pour les déclarations par statut
    public function scopeByStatut($query, $statut)
    {
        return $query->where('statut', $statut);
    }

    // Scope pour les déclarations d'un département
    public function scopeByDepartement($query, $departementId)
    {
        return $query->where('departement_id', $departementId);
    }

    // Scope pour les déclarations d'une commune
    public function scopeByCommune($query, $communeId)
    {
        return $query->where('commune_id', $communeId);
    }

    // Scope pour les déclarations d'un arrondissement
    public function scopeByArrondissement($query, $arrondissementId)
    {
        return $query->where('arrondissement_id', $arrondissementId);
    }

    public function medias(){
        return $this->hasMany(Media::class);
    }
    
}
