<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = "statuses";
    protected $primaryKey = "id";

    // public function order() {
    //     return $this->hasMany("App\OrderPizza");
    // }
}
