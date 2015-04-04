<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Alexa extends Model
{
    protected $table = 'alexas';

    protected $fillable = ['ranking', 'url', 'description'];
}