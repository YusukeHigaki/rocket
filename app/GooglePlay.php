<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class GooglePlay extends Model {

    protected $table = 'googleplays';

    protected $fillable = ['ranking', 'name', 'icon', 'url'];

}
