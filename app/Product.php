<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'sku', 'name','imageUrl', 'quantity','price','description'
    ];

    public function setNameAttribute($value){
        $this->attributes['name'] = strtoupper($value);
    }
    public function setDescriptionAttribute($value){
        $this->attributes['description'] = strtoupper($value);
    }

    protected $primaryKey = 'sku';
    public $incrementing = false;
    protected $keyType = 'string';
}
