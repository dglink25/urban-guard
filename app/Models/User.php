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




}
