<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\User;
use App\Helper\Token;

class CategoryController extends Controller
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
        
        $email = $request->data_token->email;

        $user = User::where('email', $email)->first();

        $category = new Category();

        $category->add_category($request, $user);

        return response()->json([
            'message' => 'nueva categoria'
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

        if (isset($user)) {
            $category = Category::where('user_id', $user->id)->get();

            return response()->json([
                'User' => $user,
                'Categories' => $category
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
    public function update(Request $request)
    {
        $category_previous = $request->PreviousName;
        $category = Category::where('name', $category_previous)->first();

        $category->name = $request->NewName;
        $category->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $category_name = $request->name;
        $category = Category::where('name', $category_name)->first();

        $category->delete();

        return response()->json([
            'message' => 'la categoria ha sido eliminada'
        ], 200);
    }
}
