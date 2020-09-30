<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;
use App\blacklist;
use App\member;

class adminblacklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainactive = 'blacklists';
        $subactive  = 'blacklists';
        $logo       = DB::table('settings')->value('logo');
        $allblacklists = blacklist::orderBy('id', 'desc')->get();
        $users = member::all();
        return view('admin.blacklists.index', compact('mainactive', 'subactive', 'logo', 'allblacklists', 'users'));
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
        $this->validate($request, [
            'user_id'    => 'required',
            
        ]);


        $newblacklist          = new blacklist;
        $newblacklist->user_id     = $request['user_id'];
        $newblacklist->message     = $request['message'];



        $newblacklist->save();
        session()->flash('success', 'تم اضافة مستخدم جديد للقائمة السوداء بنجاح');
        return back();
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
        $mainactive = 'blacklists';
        $subactive  = 'edblacklists';
        $logo       = DB::table('settings')->value('logo');
        $blacklist  = blacklist::find($id);
        $users = member::all();
        return view('admin.blacklists.edit', compact('mainactive', 'blacklist', 'logo', 'subactive', 'users'));
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
        $upblacklist= blacklist::find($id);


        $this->validate($request, [
            'user_id'    => 'required',
            
        ]);

        $upblacklist->user_id  = $request['user_id'];
        $upblacklist->message  = $request['message'];

        $upblacklist->save();
        session()->flash('success', 'تم تعديل القائمة بنجاح');
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
        blacklist::find($id)->delete();
        session()->flash('success', 'تم حذف المستخدم من القائمة السوداء بنجاح');
        return back();
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("blacklists")->whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => "تم الحذف بنجاح"]);
    }
}
