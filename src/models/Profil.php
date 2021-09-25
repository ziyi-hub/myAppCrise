<?php


namespace crise\models;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $table = 'profil';
    protected $primaryKey = 'idProfil';
    public $timestamps = false;
}