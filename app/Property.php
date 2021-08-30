<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = "properties";
    protected $primaryKey = "property_id";

    public function user() {
        return $this->belongsTo("App\User");
    }
}
