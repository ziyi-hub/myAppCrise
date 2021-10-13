<?php


namespace crise\models;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'Contact';
    protected $primaryKey = 'idContact';
    public $timestamps = false;
}