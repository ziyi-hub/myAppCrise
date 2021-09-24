<?php


namespace crise\models;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'group';
    protected $primaryKey = 'idGroup';
    public $timestamps = false;
}