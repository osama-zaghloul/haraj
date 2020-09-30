<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\admin;
use DB;

class providerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainactive="provider";
        $subactive = "addprovider";
        $logo = DB::table('settings')->value('logo');
        $providers = admin::where('id' , '!=' ,session('adminID'))->get();
        return view('admin.provider.index',compact('providers','logo','mainactive','subactive'));
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
        $this->validate($request,[
            'username' => 'required|max:120',
            'pass' => 'required|min:6',
            'image' =>'required | image',
            'repass'=> 'required| same:pass',
        ]);
         
        $newadmin = new admin;
        $username =  str_replace (' ','',$request['username']);
        $exituser = admin::where('username',$username)->get();

        if( count($exituser) > 0)
        {
            session()->put('exituser','username already exist , enter different one !');
            return back();
        }
        else
        {
            $newadmin->username = $username;
            $newadmin->password     = bcrypt($request['pass']);
          
            if($request->hasFile('image'))
            {
                $image = $request['image'];
                $filename = rand(0,9999).'.'.$image->getClientOriginalExtension();
                $image->move(base_path('users/images/'),$filename);
                $newadmin->image = $filename;
            }
            $newadmin->save();
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
        if( session('adminID') == 1 )
        {
            $mainactive="provider";
            $subactive = "addprovider";
            $logo = DB::table('settings')->value('logo');
            $edprovider = admin::find($id);
            return view('admin.provider.edit',compact('edprovider','mainactive','logo','subactive'));
        }
        elseif($id == session('adminID'))
        {
            $mainactive="provider";
            $subactive = "addprovider";
            $logo = DB::table('settings')->value('logo');
            $edprovider = admin::find($id);
            return view('admin.provider.edit',compact('edprovider','mainactive','logo','subactive'));
        }

        else
        {
            $mainactive="provider";
            $subactive = "addprovider";
            $logo = DB::table('settings')->value('logo');
            $edprovider = admin::find(auth()->guard('admin')->user()->id);
            return view('admin.provider.edit',compact('edprovider','mainactive','logo','subactive'));
        }
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
        $oldpass = admin::where('id',$id)->first();
        $this->validate($request, [
            'pass' => 'required|min:6',
            'repass' => 'required|same:pass',
        ]);

        $upadmin = admin::find($id);
        $upadmin->password = bcrypt($request['pass']);
        $upadmin->save();
        session()->put('updatedpass' , 'password updated successfully !');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delprovider = admin::find($id);
        $delprovider->delete();
        return back();
    }
}
