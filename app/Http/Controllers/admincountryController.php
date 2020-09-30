<?php

namespace App\Http\Controllers;

use App\City;
use App\country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class admincountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainactive      = 'cities';
        $subactive       = 'country';

        $logo = DB::table('settings')->value('logo');
        $countries = country::all();
        return view('admin.cities.countries', compact('logo', 'countries', 'mainactive', 'subactive'));
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
            'name'   => 'required|unique:countries',

        ]);

        $newcountry            = new country();
        $newcountry->name = $request['name'];

        $newcountry->save();
        session()->flash('success', 'تم إضافة دولة جديدة');
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
        $upcountry = country::find($id);
        $this->validate($request, [
            'name'   => 'required|unique:countries,name,' . $id,

        ]);

        $upcountry->name     = $request['name'];


        $upcountry->save();
        session()->flash('success', 'تم تعديل اسم الدولة بنجاح');
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
        $delcountry = country::find($id);
        if ($delcountry) {
            City::where('country_id', $delcountry->id)->delete();
            $delcountry->delete();
            session()->flash('success', 'تم حذف الدولة بنجاح');
        }

        return back();
    }
}
