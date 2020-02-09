<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('is_completed', '1')->get();
        $non_users = User::where('is_completed', '0')->get();
        $removed_users = User::onlyTrashed()->get();
        return view('admin.users.index')
            ->with('users', $users)
            ->with('non_users', $non_users)
            ->with('removed_users', $removed_users);
    }
    public function create(Request $request)
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users|email',
            'user_type' => 'required'
        ]);
        User::create([
            'email' => $request->email,
            'user_type' => $request->user_type

        ]);
        return redirect(route('users.index'));
    }

    public function edit(User $user)
    {
        return view('admin.users.create')->with('user', $user);
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'user_type' => 'required'
        ]);
        $user->update([
            'email' => $request->email,
            'user_type' => $request->user_type
        ]);
        return redirect(route('users.index'));
    }

    public function destroy(User $user)
    {
        $user->forceDelete();
        return redirect(route('users.index'));
    }

    public function showProfile(User $user)
    {
        return view('admin.users.show')->with('user', $user);
    }

    public function updateProfile(Request $request, User $user)
    {
        $data = $request->only(['name', 'birthday']);
        if($request->password != '')
            $data['password'] = Hash::make($request->password);
        if($request->hasFile('photo')) {
            $name = Str::slug($request['photo']->getClientOriginalName());
            $filename = str_replace(array('jpg', 'jpeg', 'png', 'svg'), '', $name);
            $filename = $filename . time() . '.' . $request['photo']->getClientOriginalExtension();
            $photo = $request['photo']->storeAs('storage/users', $filename);
            @unlink('/storage/'.$user->photo);
            $data['photo'] = $photo;
        }
        $user->update($data);
        return redirect(route('users.index'));
    }

    public function removeUser(User $user)
    {
        $user->delete();
        return redirect()->back();
    }

    public function restoreUser($id)
    {
        $user = User::withTrashed()->where('id', $id)->firstOrFail();
        $user->restore();
        return redirect()->back();
    }

    public function signup()
    {
        return view('auth.verify-email');
    }

    public function checkemail(Request $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();
        if($user->email == $request->email && $user->is_completed == 0)
            $user->forceDelete();
            return redirect('kayitol')
                ->with('email', $user->email)
                ->with('type', $user->user_type);

    }
}
