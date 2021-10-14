<?php


namespace crise\models;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $table = 'Board';
    protected $primaryKey = 'idBoard';
    public $timestamps = false;
}