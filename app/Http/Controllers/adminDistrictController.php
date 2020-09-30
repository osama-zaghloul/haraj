<?php

namespace App\Http\Controllers;

use App\City;
use App\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminDistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainactive      = 'cities';
        $subactive       = 'district';
       
        $logo = DB::table('settings')->value('logo');
        $cities = City::all();
        $districts= District::all();
        return view('admin.cities.indexx',compact('logo','cities','districts','mainactive','subactive'));
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
            'name'   => 'required|unique:districts',
            'city'   => 'required',
         ]);

        $newdistrict              = new District();
        $newdistrict->name = $request['name'];
        $newdistrict->cities_id = $request['city'];
       
        $newdistrict->save();
        session()->flash('success','تم إضافة حي جديد');
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
        $updistrict = District::find($id);
        $this->validate($request,[
            'name'   => 'required|unique:districts,name,'.$id,
            
         ]);

        $updistrict->name     = $request['name'];
        $updistrict->cities_id     = $request['city'];
        
        
        $updistrict->save();
        session()->flash('success','تم تعديل اسم الحي بنجاح');
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
         $deldistrict = District::find($id);
        
        $deldistrict->delete();
        return back(); 
    }
}
