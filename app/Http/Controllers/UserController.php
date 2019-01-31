<?php

namespace App\Http\Controllers;

use App\Helpers\Constant;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();

        return view('users.create', compact('user'));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store(Constant::DIR_AVATAR);
            $data['avatar'] = "/storage/$path";
        }

        $user = User::create($data);

        return redirect()->route('users.create');
    }
}
