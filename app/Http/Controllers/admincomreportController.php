<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\setting;
use App\comment_report;
use DB;

class admincomreportController  extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainactive   = "reports";
        $subactive    =  "comreport";
        $logo         = DB::table('settings')->value('logo');
        $allreports = comment_report::orderBy('id', 'desc')->get();
        return view('admin.reports.comreports', compact('allreports', 'mainactive', 'logo', 'subactive'));
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
        comment_report::find($id)->delete();
        return back();
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("comment_reports")->whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => "تم الحذف بنجاح"]);
    }
}
