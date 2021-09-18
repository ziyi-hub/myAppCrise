<?php


namespace crise\models;
use Illuminate\Database\Eloquent\Model;

class Localisations extends Model
{
    protected $table = 'localisations';
    protected $primaryKey = 'numLocal';
    public $timestamps = false;
}