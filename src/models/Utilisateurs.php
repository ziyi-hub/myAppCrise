<?php


namespace crise\models;
use \Illuminate\Database\Eloquent\Model as Modele;

class Utilisateurs extends Modele
{
    protected $table = 'utilisateurs';
    protected $primaryKey = 'idUtilisateur';
    public $timestamps = false;
}