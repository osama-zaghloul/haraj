<?php

namespace App\Http\Controllers;

use App\City;
use App\comment;
use App\country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Mail\notificationmail;
use App\Mail\contactmail;
use Illuminate\Support\Facades\Mail;
use App\member;
use App\item;
use App\bill;
use App\favorite_item;
use App\report;
use App\comment_report;
use App\blacklist;
use Carbon\Carbon;
use DB;


class adminmemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainactive = 'users';
        $subactive  = 'user';
        $logo       = DB::table('settings')->value('logo');
        $allusers   = member::orderBy('id', 'desc')->get();
        return view('admin.users.index', compact('mainactive', 'subactive', 'logo', 'allusers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mainactive = 'users';
        $subactive  = 'adduser';
        $logo       = DB::table('settings')->value('logo');

        $countries = country::all();
        return view('admin.users.create', compact('mainactive', 'logo', 'subactive', 'countries'));
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
            'name'        => 'required',
            'phone'       => 'required|unique:members',
            'country_id'       => 'required',
            'city_id'       => 'required',
            'pass'        => 'required|min:6',
            'confirmpass' => 'required|same:pass',
        ]);

        $newmember            = new member;
        $newmember->name      = $request['name'];
        $newmember->phone     = $request['phone'];
        $newmember->country_id     = $request['country_id'];
        $newmember->city_id     = $request['city_id'];
        $newmember->password  = Hash::make($request['pass']);
        $newmember->connect  = now();
        $newmember->save();
        session()->flash('success', 'تم اضافة عضو بنجاح');
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
        $mainactive        = 'users';
        $subactive         = 'user';
        $logo              = DB::table('settings')->value('logo');
        $showuser          = member::find($id);
        $country = country::where('id', $showuser->country_id)->first();
        $city = City::where('id', $showuser->city_id)->first();
        $myfavourites      = favorite_item::where('user_id', $id)->orderBy('id', 'desc')->get();
        $items = item::where('user_id', $showuser->id)->get();
        $comments = comment::where('user_id', $showuser->id)->get();
        $mytotal           = 0;
        return view('admin.users.show', compact('mainactive', 'subactive', 'logo', 'showuser', 'myfavourites', 'mytotal', 'country', 'city', 'items', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mainactive = 'users';
        $subactive  = 'edituser';
        $logo       = DB::table('settings')->value('logo');
        $eduser     = member::find($id);
        $cities = City::where('country_id', $eduser->country_id)->get();
        $countries = country::all();
        return view('admin.users.edit', compact('mainactive', 'subactive', 'logo', 'eduser', 'countries', 'cities'));
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
        $upmember = member::find($id);

        if (Input::has('suspensed')) {
            if ($upmember->suspensed == 0) {
                DB::table('members')->where('id', $id)->update(['suspensed' => 1]);
                session()->flash('success', 'تم تعطيل عضوية العضو بنجاح');
                return back();
            } else {
                DB::table('members')->where('id', $id)->update(['suspensed' => 0]);
                session()->flash('success', 'تم تفعيل عضوية العضو بنجاح');
                return back();
            }
        } else {
            $this->validate($request, [
                'name'        => 'required',
                'phone'       => 'required|unique:members,phone,' . $id,
                'country_id'       => 'required',
                'city_id'       => 'required',
            ]);

            $upmember->name      = $request['name'];
            $upmember->phone     = $request['phone'];
            $upmember->country_id   = $request['country_id'];
            $upmember->city_id   = $request['city_id'];
            $upmember->password  = $request['pass'] ? Hash::make($request['pass']) : $upmember->password;
            $upmember->save();
            session()->flash('success', 'تم تعديل بيانات العضو بنجاح');
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

        $deluser = member::find($id);
        if ($deluser) {
            

            bill::where('user_id', $deluser->id)->delete();
            item::where('user_id', $deluser->id)->delete();
            report::where('user_id', $deluser->id)->delete();
            favorite_item::where('user_id', $deluser->id)->delete();
            comment::where('user_id', $deluser->id)->delete();
            blacklist::where('user_id', $deluser->id)->delete();
            comment_report::where('user_id', $deluser->id)->delete();
            $deluser->delete();
            session()->flash('success', 'تم حذف العضو بنجاح');

            return back();
        }
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $users = DB::table("members")->whereIn('id', explode(",", $ids))->get();
        foreach ($users as $user) {
            bill::where('user_id', $user->id)->delete();
            item::where('user_id', $user->id)->delete();
            report::where('user_id', $user->id)->delete();
            favorite_item::where('user_id', $user->id)->delete();
            comment::where('user_id', $user->id)->delete();
            member::where('id', $user->id)->delete();
        }
        return response()->json(['success' => "تم الحذف بنجاح"]);
    }
}
