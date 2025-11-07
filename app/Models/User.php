<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_departement', 
        'id_commune', 
        'id_arrondissement', 
        'id_quartier',
        'rue', 
        'maison', 
        'role', 
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array{
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function departementsDiriges(){
        return $this->hasMany(Departement::class, 'id_prefect');
    }

    public function communesDirigees(){
        return $this->hasMany(Commune::class, 'id_maire');
    }

    public function arrondissementsDiriges(){
        return $this->hasMany(Arrondissement::class, 'id_ca');
    }

    public function quartiersDiriges(){
        return $this->hasMany(Quartier::class, 'id_cq');
    }

    public function arrondissementDirige(){
        return $this->hasOne(Arrondissement::class, 'id_ca');
    }

    public function communeDirigee(){
        return $this->hasOne(Commune::class, 'id_maire');
    }

    public function departementDirige(){
        return $this->hasOne(Departement::class, 'id_prefet');
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relation avec les déclarations créées par l'utilisateur
    public function declarations()
    {
        return $this->hasMany(Declaration::class);
    }

    // Relation avec les déclarations suivies par l'utilisateur
    public function followedDeclarations()
    {
        return $this->belongsToMany(Declaration::class, 'declaration_user')
                    ->withTimestamps();
    }

    // Relation avec le département (pour préfet)
    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    // Relation avec la commune (pour maire)
    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

    // Relation avec l'arrondissement (pour chef d'arrondissement)
    public function arrondissement()
    {
        return $this->belongsTo(Arrondissement::class);
    }

    // Vérifie si l'utilisateur suit une déclaration
    public function followsDeclaration($declarationId){
        return $this->followedDeclarations()->where('declaration_id', $declarationId)->exists();
    }

    // Suivre une déclaration
    public function followDeclaration($declarationId)
    {
        if (!$this->followsDeclaration($declarationId)) {
            $this->followedDeclarations()->attach($declarationId);
            return true;
        }
        return false;
    }

    // Ne plus suivre une déclaration
    public function unfollowDeclaration($declarationId)
    {
        if ($this->followsDeclaration($declarationId)) {
            $this->followedDeclarations()->detach($declarationId);
            return true;
        }
        return false;
    }

    // Méthodes pour vérifier les rôles
    public function isPrefet()
    {
        return $this->role === 'prefet';
    }

    public function isMaire()
    {
        return $this->role === 'maire';
    }

    public function isChefArrondissement()
    {
        return $this->role === 'chef_arrondissement';
    }

    public function isCitoyen()
    {
        return $this->role === 'citoyen';
    }




}
