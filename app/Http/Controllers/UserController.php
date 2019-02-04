<?php

namespace App\Http\Controllers;

use App\Helpers\Constant;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('users');

    }

    /**
     * Upload the specified image and replace existing image from storage if any.
     *
     * @param \Illuminate\Http\Request  $request
     * @param  \App\Model\User  $user
     * q@return \Illuminate\Http\RedirectResponse
     */
    public function upload(Request $request, User $user)
    {
        $this->validate($request, ['avatar' => 'required|image|max:1000']);

        $path = $request->file('avatar')->store(Constant::DIR_AVATAR);

        if ($user->avatar) {
            Storage::delete(str_replace("/storage/", "", $user->avatar));
        }

        $user->update(['avatar' => "/storage/$path"]);

        return redirect()->route('users.show', $user);
    }
}
