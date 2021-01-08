<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPizza extends Model
{
    protected $table = "orders";

    protected $primaryKey = "id";

    // define elqouent relationship
    public function user() {
        return $this->belongsTo("App\User");
    }

    public function status() {
        return $this->belongsTo("App\Status");
    }
}
