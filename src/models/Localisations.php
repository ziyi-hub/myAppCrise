<?php


namespace crise\models;
use Illuminate\Database\Eloquent\Model;

class Localisations extends Model
{
    protected $table = 'Localisations';
    protected $primaryKey = 'numLocal';
    public $timestamps = false;
}