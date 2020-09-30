<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;
use App\commission;
use App\maincategory;

class admincommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainactive = 'commissions';
        $subactive  = 'commission';
        $logo       = DB::table('settings')->value('logo');
        $allcommissions = commission::all();
        $cats = maincategory::all();
        return view('admin.commissions.index', compact('mainactive', 'subactive', 'logo', 'allcommissions', 'cats'));
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
            'category_id'    => 'required',
            'commission'      => 'required',
        ]);


        $newcommission             = new commission;
        $newcommission->category_id     = $request['category_id'];
        $newcommission->commission     = $request['commission'];



        $newcommission->save();
        session()->flash('success', 'تم اضافة عمولة جديدة بنجاح');
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
        $mainactive = 'commissions';
        $subactive  = 'edcommission';
        $logo       = DB::table('settings')->value('logo');
        $commission   = commission::find($id);
        $cats = maincategory::all();
        return view('admin.commissions.edit', compact('mainactive', 'commission', 'logo', 'subactive', 'cats'));
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
        $upcommission = commission::find($id);


        $this->validate($request, [
            'category_id'    => 'required',
            'commission'   => 'required',

        ]);

        $upcommission->category_id  = $request['category_id'];
        $upcommission->commission  = $request['commission'];

        $upcommission->save();
        session()->flash('success', 'تم تعديل العمولة بنجاح');
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
        commission::find($id)->delete();
        session()->flash('success', 'تم حذف العمولة بنجاح');
        return back();
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("commissions")->whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => "تم الحذف بنجاح"]);
    }
}
