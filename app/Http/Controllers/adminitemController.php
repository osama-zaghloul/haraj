<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use DB;
use App\member;
use App\rate;
use App\item;
use App\item_image;
use App\favorite_item;
use App\category;
use App\City;
use App\maincategory;
use App\comment;
use App\country;
use App\report;

class adminitemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $mainactive = 'items';
        $subactive  = 'item';
        $logo       = DB::table('settings')->value('logo');
        $allitems   = item::orderBy('id', 'desc')->get();

        return view('admin.items.index', compact('mainactive', 'logo', 'subactive', 'allitems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mainactive = 'items';
        $subactive  = 'additem';
        $logo       = DB::table('settings')->value('logo');
        $allusers = member::all();
        $allcats   = maincategory::orderBy('id', 'desc')->get();
        $countries = country::all();
        return view('admin.items.create', compact('mainactive', 'subactive', 'logo', 'allcats', 'allusers', 'countries'));
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
            'artitle'     => 'required|max:200',
            'price'       => 'required',
            'category_id'       => 'required',
            'user_id'       => 'required',
            'country_id'       => 'required',
            'city_id'       => 'required',
        ]);
        $newitem                = new item;
        $newitem->code          = date('dmY') . rand(0, 99);
        $newitem->artitle       = $request['artitle'];
        $newitem->price         = $request['price'];
        $newitem->user_id     = $request['user_id'];
        $newitem->details       = $request['ardesc'];
        $newitem->category_id       = $request['category_id'];
        $newitem->country_id       = $request['country_id'];
        $newitem->city_id       = $request['city_id'];
        $newitem->phone = $request['phone'];
        $newitem->whatsapp = $request['whatsapp'];
        if ($request->hasFile('video')) {

            $video    = $request->video;
            $filename = rand(0, 9999) . '.' . $video->getClientOriginalExtension();
            $video->move(base_path('users/videos/'), $filename);
            $newitem->video = $filename;
        }
        $newitem->save();

        $items = $request['items'];
        if ($items) {
            foreach ($items as $item) {
                $newimg = new item_image;
                $img_name = rand(0, 999) . '.' . $item->getClientOriginalExtension();
                $item->move(base_path('users/images/'), $img_name);
                $newimg->image   = $img_name;
                $newimg->item_id = $newitem->id;
                $newimg->save();
            }
        }
        session()->flash('success', 'تم اضافة المنتج بنجاح');
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
        $mainactive = 'items';
        $subactive  = 'item';
        $logo       = DB::table('settings')->value('logo');
        $showitem   = item::findorfail($id);
        $adimg      = item_image::where('item_id', $id)->first();
        $adimages   = item_image::where('item_id', $id)->get();
        $user       = member::where('id', $showitem->user_id)->first();
        $catname    = maincategory::where('id', $showitem->category_id)->value('name');
        $country = country::where('id', $showitem->country_id)->first();
        $city = City::where('id', $showitem->city_id)->first();
        return view('admin.items.show', compact('mainactive', 'logo', 'subactive', 'showitem', 'adimages', 'adimg', 'catname', 'user', 'country', 'city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mainactive = 'items';
        $subactive  = 'item';
        $logo       = DB::table('settings')->value('logo');
        $editem     = item::findorfail($id);
        $adimages   = item_image::where('item_id', $id)->get();
        $allcats   = maincategory::orderBy('id', 'desc')->get();
        $allusers = member::all();
        $cities = City::where('country_id', $editem->country_id)->get();
        $countries = country::all();
        return view('admin.items.edit', compact('mainactive', 'logo', 'subactive', 'editem', 'adimages', 'allcats', 'allusers','countries','cities'));
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
        $upitem = item::find($id);
        if (Input::has('suspensed')) {
            if ($upitem->suspensed == 0) {
                DB::table('items')->where('id', $id)->update(['suspensed' => 1]);
                session()->flash('success', 'تم تعطيل المنتج بنجاح');
                return back();
            } else {
                DB::table('items')->where('id', $id)->update(['suspensed' => 0]);
                session()->flash('success', 'تم تفعيل المنتج بنجاح');
                return back();
            }
        } else {
            $this->validate($request, [
                'artitle'     => 'required|max:200',
                'price'       => 'required',
                'category_id'       => 'required',
                'user_id'       => 'required',
                'country_id'       => 'required',
                'city_id'       => 'required',
            ]);




            $upitem->code          = $upitem->code;
            $upitem->artitle       = $request['artitle'];
            $upitem->price         = $request['price'];
            $upitem->user_id     = $request['user_id'];
            $upitem->details       = $request['ardesc'];
            $upitem->category_id       = $request['category_id'];
            $upitem->country_id       = $request['country_id'];
            $upitem->city_id       = $request['city_id'];
            $upitem->phone = $request['phone'];
            $upitem->whatsapp = $request['whatsapp'];
            if ($request->hasFile('video')) {

                $video    = $request->video;
                $filename = rand(0, 9999) . '.' . $video->getClientOriginalExtension();
                $video->move(base_path('users/videos/'), $filename);
                $upitem->video = $filename;
            }
            $upitem->save();
            $items = $request['items'];
            if ($items) {
                foreach ($items as $item) {
                    $newimg   = new item_image;
                    $img_name = rand(0, 999) . '.' . $item->getClientOriginalExtension();
                    $item->move(base_path('users/images/'), $img_name);
                    $newimg->image   = $img_name;
                    $newimg->item_id = $id;
                    $newimg->save();
                }
            }
            session()->flash('success', 'تم تعديل المنتج بنجاح');
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
        if (Input::has('del-single-image')) {
            $delimg = item_image::find($id)->delete();
            session()->flash('success', 'تم حذف الصورة بنجاح');
            return back();
        } elseif (Input::has('delcomment')) {
            comment::where('id', $id)->delete();
            session()->flash('success', 'تم حذف التعليق بنجاح');
            return back();
        } else {
            $delitem = item::find($id);
            item_image::where('item_id', $id)->delete();
            favorite_item::where('item_id', $id)->delete();
            comment::where('item_id', $id)->delete();
            report::where('ad_num', $delitem->code)->delete();
            $delitem->delete();
            session()->flash('success', 'تم حذف المنتج بنجاح');
            return back();
        }
    }

    public function deleteAll(Request $request)
    {
        $ids           = $request->ids;
        $selecteditems = DB::table("items")->whereIn('id', explode(",", $ids))->get();
        foreach ($selecteditems as $item) {
            item_image::where('item_id', $item->id)->delete();
            favorite_item::where('item_id', $item->id)->delete();
            comment::where('item_id', $item->id)->delete();
            report::where('ad_num', $item->code)->delete();
            item::where('id', $item->id)->delete();
        }
        return response()->json(['success' => "تم الحذف بنجاح"]);
    }

    public function showcomments($id)
    {
        $mainactive = 'items';
        $subactive  = 'itemcomments';
        $logo       = DB::table('settings')->value('logo');
        $comments = comment::where('item_id', $id)->get();
        return view('admin.items.showcomments', compact('mainactive', 'logo', 'subactive', 'comments'));
    }
}
