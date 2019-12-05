<?php

namespace App\Http\Controllers;

use App\Password;
use App\Category;
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
    public function show($id)
    {
        $passwords = Password::all();
        dd($passwords);
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
