<?php

namespace App\Http\Controllers;

use App\Password;
use App\Category;
use App\User;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category_name = $request->category_name;
        $category = Category::where('name', $category_name)->first();
        $password = new Password();
        $password->add_password($request, $category);

        return response()->json([
            'message' => 'nueva password'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $email = $request->data_token->email;
        $user = User::where('email', $email)->first(); 

        $passwordArray = array();

        if (isset($user)) {
            $categories = Category::where('user_id', $user->id)->get();
            foreach ($categories as $key => $category) {
                $password = Password::where('category_id', $category->id)->get();
                array_push($passwordArray, $password);
            }
            return response()->json([
            'User' => $user,
            'Passwords' => $passwordArray
            ], 200);
        } 
        else
        {
            return response()->json([
                'error' => 'No existe ese usuario'
            ]);
        }    

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $password_previous = $request->PreviousTitle;
        $password = Password::where('title', $password_previous)->first();

        $password->title = $request->NewTitle;
        $password->password = $request->NewPassword;
        $password->update();    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $password_title = $request->title;
        $password = Password::where('title', $password_title)->first();

        $password->delete();

        return response()->json([
            'message' => 'la password sido eliminada'
        ], 200);
    }
}
