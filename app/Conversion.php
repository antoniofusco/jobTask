<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{
    // define which attributes are mass assignable (for security)
    // we only want these 3 attributes able to be filled
    protected $fillable = array('number', 'roman', 'user_id');
	
	// DEFINE RELATIONSHIPS --------------------------------------------------
    // each conversion HAS one user
    public function user() {
        return $this->hasOne('User'); // this matches the Eloquent model
    }
	
}