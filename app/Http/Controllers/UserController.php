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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::orderBy('name')->paginate('15');
        
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user = new User();

        return view('users.create', compact('user'));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\RedirectResponse
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

        return redirect()->route('users.show', $user);
    }

    /**
     * Display the specified user.
     *
     * @param  \App\Model\User  $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  \App\Model\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  App\Http\Requests\UserRequest  $request
     * @param  \App\Model\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->all();

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update(array_except($data, ['avatar']));

        return redirect()->route('users.show', $user);
    }
}
