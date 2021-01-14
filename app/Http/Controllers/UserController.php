<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Alert;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = User::where('id_user', '!=', Auth::user()->id_user)->get();
        $user = User::all();
        return view('admin.user.index', compact('user'));
    }

    public function changestatus($id) {
        $user = User::findOrFail($id);
        if($user->status == '0'){
			$change = '1';
		}else{
			$change = '0';
        }
        $user->status = $change;
        $user->save();
		Alert::success('Update Status User', 'Status User berhasil diperbarui');
        return redirect('admin/user');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mydata = ([
            'name_user' => $request['name'],
            'username'=> $request['username'],
            'email' => $request['email'],
            'address' => $request['address'],
            'phone' => $request['phone'],
            'gender' => $request['gender'],
            'birthday' => $request['birthday'],
            'role' => $request['role'],
            'password' => Hash::make($request['password']),
        ]);
        User::create($mydata);
        Alert::success('Add new User', 'User berhasil ditambahkan');
        return redirect('admin/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
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
        $user = User::findOrFail($request->id);

        $user->name_user = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->birthday = $request->birthday;
        $user->role = $request->role;
        $user->save();
        // User::where('id_user',$request->id)->update($mydata);
        Alert::success('Update Akun User', 'Akun berhasil diupdate');
        return redirect('admin/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Alert::warning('Delete User', 'User berhasil dihapus');
        return redirect('admin/user');
    }
}
