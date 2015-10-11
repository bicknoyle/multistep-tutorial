<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	public function getValuesAttribute($value) {
		return json_decode($value, true);
	}

    public function setValuesAttribute($value) {
    	if (!is_array($value)) {
    		$value = [$value];
    	}

    	 $this->attributes['values'] = json_encode($value);
    }
}
