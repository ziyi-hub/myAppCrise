<?php


namespace crise\models;
use Illuminate\Database\Eloquent\Model;

class Utilisateurs extends Model
{
    protected $table = 'Utilisateurs';
    protected $primaryKey = 'idUtilisateur';
    public $timestamps = false;

    public function profil(){
        return $this->belongsTo(
            Profil::class, "idProfil", "idProfil");
    }
}