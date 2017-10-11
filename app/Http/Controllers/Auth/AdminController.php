<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin');
    }

    public function show(Admin $admin)
    {
        return view('admin/admin-edit')->with('admin', $admin);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        Admin::create($data);
        return redirect('/admin');
    }

    public function edit(Request $request, Admin $admin)
    {
        // $this->validate($request, [
        //     'name' => 'string|max:255',
        //     'email' => 'string|email|max:255|qnique:admins'
        // ]);

        $data = $request->all();
        if($request->has('name')){
            $admin->name = $request->name;
        }

        if($request->has('email') && $request->email != $admin->email){
            $admin->email = $request->email;
        }

        if($request->has('password')){
            $admin->password = bcrypt($request->password);
        }

        $admin->save();
        return redirect('/admin/show/' . $admin->id);
    }

    public function delete(Admin $admin)
    {
        $admin->delete();
        return redirect('/admin');
    }
}
