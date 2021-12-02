<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faqs extends Model
{
    protected $table = 'faqs';

    public $fillable = ['Question','Answer','status','order_number'];
}
