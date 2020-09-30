<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\setting;
use DB;

class adminbannedadsController  extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainactive   = "setting";
        $subactive    = "bannedads";
        $logo         = DB::table('settings')->value('logo');
        $bannedads = setting::first();
        return view('admin.setting.bannedads', compact('bannedads', 'mainactive', 'logo', 'subactive'));
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
        //
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
        $this->validate($request, [
            'bannedads' => 'required',
             'bannedads1' => 'required',
        ]);
        $upinfo                 = setting::find($id);
        $upinfo->banned_ads   = $request['bannedads'];
        $upinfo->banned_ads1   = $request['bannedads1'];
        $upinfo->save();
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
        //
    }
}
