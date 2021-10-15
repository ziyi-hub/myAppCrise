<?php


namespace crise\models;
use Illuminate\Database\Eloquent\Model;

class Utilisateurs extends Model
{
    protected $table = 'Utilisateurs';
    protected $primaryKey = 'idUtilisateur';
    public $timestamps = false;

    public function message(){
        return $this->belongsToMany(
            "crise\models\Messages", "Contact", "idUtilisateur", "idMessage");
    }
}