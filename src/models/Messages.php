<?php


namespace crise\models;
use Illuminate\Database\Eloquent\Model as Modele;

class Messages extends Modele
{
    protected $table = 'Messages';
    protected $primaryKey = 'idMessage';
    public $timestamps = false;
}