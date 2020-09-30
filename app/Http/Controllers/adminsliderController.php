<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;
use App\slider;

class adminsliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainactive = 'setting';
        $subactive  = 'slider';
        $logo       = DB::table('settings')->value('logo');
        $allsliders = slider::all();
        return view('admin.sliders.index', compact('mainactive', 'subactive', 'logo', 'allsliders'));
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
            'artitle'    => 'required',
            'url'        => 'required',
            'image'      => 'required|image',
        ]);


        $newslider              = new slider;
        $newslider->artitle     = $request['artitle'];
        $newslider->text     = $request['text'];
        $newslider->url         = $request['url'];

        if ($request->hasFile('image')) {
            $image = $request['image'];
            $filename = rand(0, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(base_path('users/images/'), $filename);
            $newslider->image = $filename;
        }
        $newslider->save();
        session()->flash('success', 'تم اضافة سليدر جديدة بنجاح');
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
        $mainactive = 'setting';
        $subactive  = 'slider';
        $logo       = DB::table('settings')->value('logo');
        $edslider   = slider::find($id);
        return view('admin.sliders.edit', compact('mainactive', 'edslider', 'logo', 'subactive'));
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
        $upslider = slider::find($id);

        if (Input::has('suspensed')) {
            if ($upslider->suspensed == 0) {
                DB::table('sliders')->where('id', $id)->update(['suspensed' => 1]);
                session()->flash('success', 'تم تعطيل سليدر بنجاح');
                return back();
            } else {
                DB::table('sliders')->where('id', $id)->update(['suspensed' => 0]);
                session()->flash('success', 'تم اعادة تفعيل سليدر بنجاح');
                return back();
            }
        } else {
            $this->validate($request, [
                'artitle'    => 'required',
                'url'   => 'required',
                'image' => 'image',
            ]);

            $upslider->artitle  = $request['artitle'];
            $upslider->text  = $request['text'];
            $upslider->url      = $request['url'];


            if ($request->hasFile('image')) {
                $image = $request['image'];
                $filename = rand(0, 9999) . '.' . $image->getClientOriginalExtension();
                $image->move(base_path('users/images/'), $filename);
                $upslider->image = $filename;
            }

            $upslider->save();
            session()->flash('success', 'تم تعديل السليدر بنجاح');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        slider::find($id)->delete();
        session()->flash('success', 'تم حذف السليدر بنجاح');
        return back();
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("sliders")->whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => "تم الحذف بنجاح"]);
    }
}
