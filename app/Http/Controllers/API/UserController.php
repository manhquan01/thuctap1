<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();

        foreach ($user as $item) {
            $item->view = [
                'href' => 'ap1/v1/user/' . $item->id,
                'method' => 'GET',
            ];
        }

        $response = [
            'msg' => 'List user',
            'data' => $user,
        ];

        return response()->json($response, 200);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $pass = $request->input('password');

        $user = new User([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($pass),
        ]);

        if ($user->save()) {
            $user->signin = [
                'href' => 'api/v1/user',
                'methos' => 'POST',
                'params' => 'email, name',

            ];

            $response = [
                'msg' => 'User_created',
                'data' => $user,
            ];

            return response()->json($response, 201);
        }

        $response = [
            'msg' => 'an error occurred'
        ];

        return response()->json($response, 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('post')->find($id);

        $user->edit = [
            'href' => 'api/v1/user/' . $id,
            'method' => 'PUT',
        ];

        $response = [
            'msg' => 'show user',
            'data' => $user,
        ];

        return response()->json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $pass = $request->input('password');

        $user = User::find($id);
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($pass);

        if (!$user->save()) {
            $response = ['msg' => 'Error during update'];

            return response()->json($response, 404);
        }

        $user->view_user = [
            'href' => 'api/v1/user/' . $user->id,
            'method' => 'GET',
        ];

        $response = [
            'msg' => 'User updated',
            'data' => $user,
        ];

        return response()->json($response, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
