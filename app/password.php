<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Password extends Model
{
    protected $table = 'passwords';
    protected $fillable = [
        'title',
        'password',
        'category_id'
    ];

    public function add_password(Request $request, $category)
    {
        $password = new Password();
        $password->title = $request->title;
        $password->password = $request->password;
        $password->category_id = $category->id;
        $password->save();
    }
}
