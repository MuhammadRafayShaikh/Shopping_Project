<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereNot('role', 2)->orderBy('id', 'DESC')->paginate(2);

        return view('admin.users', compact('users'));
    }

    public function singleuser(string $id)
    {
        $user = User::find($id);
        return response()->json($user);
    }
    public function blockuser(Request $request)
    {
        $user = User::find($request->user_status);
        // return response()->json($user);
        $user->update([
            'role' => 0
        ]);
        return response()->json(['status' => 'User Blocked Successfully']);
    }

    public function blockuser2(Request $request)
    {
        $user = User::find($request->user_status);
        // return response()->json($user);
        $user->update([
            'role' => 1
        ]);
        return response()->json(['status' => 'User Unblocked Successfully']);
    }

    public function back()
    {
        return redirect('/');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = User::find($request->user_id);

        $user->delete();

        return response()->json(['msg' => 'User Deleted Successfully']);
    }
}
