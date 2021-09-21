<?php


namespace crise\models;
use Illuminate\Database\Eloquent\Model;

class Utilisateurs extends Model
{
    protected $table = 'utilisateurs';
    protected $primaryKey = 'idUtilisateur';
    public $timestamps = false;
}