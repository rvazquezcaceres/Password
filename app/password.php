<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class password extends Model
{
    protected $table = 'passwords';
    protected $fillable = [
        'title',
        'password',
        'category_id'
    ];
}
