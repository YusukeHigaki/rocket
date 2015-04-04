<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AppStore extends Model {

    protected $table = 'appstores';

    protected $fillable = ['ranking', 'name', 'icon', 'url'];

}
