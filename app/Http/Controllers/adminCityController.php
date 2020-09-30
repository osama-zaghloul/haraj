<?php

namespace App\Http\Controllers;

use App\City;
use App\country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminCityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainactive      = 'cities';
        $subactive       = 'city';

        $logo = DB::table('settings')->value('logo');
        $cities = City::all();
        $countries = country::all();
        return view('admin.cities.cities', compact('logo', 'cities', 'mainactive', 'subactive', 'countries'));
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
            'name'   => 'required|unique:cities',
            'country'   => 'required',

        ]);

        $newcity              = new City();
        $newcity->name = $request['name'];
        $newcity->country_id = $request['country'];

        $newcity->save();
        session()->flash('success', 'تم إضافة مدينة جديدة');
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
        $upcity = City::find($id);
        $this->validate($request, [
            'name'   => 'required|unique:cities,name,' . $id,
            'country'   => 'required',

        ]);

        $upcity->name     = $request['name'];
        $upcity->country_id     = $request['country'];


        $upcity->save();
        session()->flash('success', 'تم تعديل اسم المدينة بنجاح');
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
        $delcity = City::find($id);

        $delcity->delete();
        return back();
    }

    public function list_cities(Request $request)
    {
        if (!$request->country_id) {
            $html = '<option value="">اختر المدينة</option>';
        } else {
            $html = '';
            $cities = City::where('country_id', $request->country_id)->get();
            foreach ($cities as $city) {
                $html .= '<option value="' . $city->id . '">' . $city->name . '</option>';
            }
        }

        return response()->json(['html' => $html]);
    }
}
