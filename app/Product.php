<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'name','detail'
    ]; // Minimal fields lang yung pwd ichange


    public function type()
    {
        return $this->belongsTo('App\Type');
    }


}
