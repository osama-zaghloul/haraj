<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\setting;
use App\report;
use DB;

class adminreportController  extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainactive   = "reports";
        $subactive    =  "report";
        $logo         = DB::table('settings')->value('logo');
        $allreports = report::orderBy('id', 'desc')->get();
        return view('admin.reports.reports', compact('allreports', 'mainactive', 'logo', 'subactive'));
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
        report::find($id)->delete();
        return back();
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("reports")->whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => "تم الحذف بنجاح"]);
    }
}
