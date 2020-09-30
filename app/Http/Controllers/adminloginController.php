<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\admin;
use App\setting;
use Illuminate\Support\Facades\Auth;

class adminloginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if (Auth::guard('admin')->check()) {
            $mainactive           = 'dashboard';
            $subactive            = 'dashboardcont';
            $logo                 = setting::value('logo');
            $allmembers           = count(DB::table('members')->get());
            $allcategories        = count(DB::table('maincategories')->get());
            $allitems             = count(DB::table('items')->get());
            $bills           = count(DB::table('bills')->get());
            $allmessages          = count(DB::table('contacts')->get());
            $alltransfers         = count(DB::table('transfers')->get());
            $allreports         = count(DB::table('transfers')->get());
            $allcities         = count(DB::table('transfers')->get());
            return view('admin.dashboard', compact('mainactive', 'subactive', 'logo', 'allmembers', 'allitems', 'bills', 'allmessages', 'alltransfers', 'allcategories', 'allreports', 'allcities'));
        } else {
            $logo = setting::value('logo');
            return view('admin.login', compact('logo'));
        }
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
        $username = $request['username'];
        $pass     = $request['pass'];

        if (Auth::guard('admin')->attempt(['username' => $username, 'password' => $pass])) {
            return redirect('adminpanel');
        } else {
            session()->put('loginfailed', 'اسم المستخدم او كلمة المرور غير صحيحة ! حاول مرة اخرى');
            return back();
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Auth::guard('admin')->logout();
        return redirect('adminpanel');
    }
}