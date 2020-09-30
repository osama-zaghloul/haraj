<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Mail\notificationmail;
use App\Mail\contactmail;
use Illuminate\Support\Facades\Mail;
use DB;    
use Carbon\Carbon;
use App\maincategory;
use App\item;
use App\commission;
use App\item_image;
use App\favorite_item;
use App\comment;
use App\report;


class adminmaincategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()   
    {
        $mainactive      = 'categories';
        $subactive       = 'maincategory';
        $logo            = DB::table('settings')->value('logo');
        $categories = maincategory::all();
        return view('admin.categories.maincategories',compact('mainactive','subactive','logo','categories'));
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
            'name'   => 'required',
             'image'   => 'required',
           
         ]);

        $newcategory              = new maincategory;
        $newcategory->name = $request['name'];
       if($request->hasFile('image'))
        {
            $image = $request['image'];
            $filename = rand(0,9999).'.'.$image->getClientOriginalExtension();
            $image->move(base_path('users/images/'),$filename);
            $newcategory->image = $filename;
        }
        $newcategory->save();
        session()->flash('success','تم اضافة قسم جديد');
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
        $mainactive      = 'categories';
        $subactive       = 'category';
        $logo         = DB::table('settings')->value('logo');
         $showcategory = Cutting::where('id',$id)->first();
        if($showcategory)
        {
            $allcategories = Cutting::where('parent',$id)->get();
            return view('admin.categories.show',compact('mainactive','subactive','logo','showcategory','allcategories'));
        }
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
        $upcategory = maincategory::find($id);
         $this->validate($request,[
            'name'   => 'required',
             
           
         ]);

        $upcategory->name     = $request['name'];
         if($request->hasFile('image'))
        {
            $image = $request['image'];
            $filename = rand(0,9999).'.'.$image->getClientOriginalExtension();
            $image->move(base_path('users/images/'),$filename);
            $upcategory->image = $filename;
        }
        
        $upcategory->save();
        session()->flash('success','تم تعديل القسم بنجاح');
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
        $delcategory = maincategory::find($id);
        if($delcategory)
        {
       $items=  item::where('category_id', $delcategory->id)->get();
       if($items){
           foreach($items as $item){
               item_image::where('item_id', $item->id)->delete();
                favorite_item::where('item_id', $item->id)->delete();
                comment::where('item_id', $item->id)->delete();
                report::where('ad_num', $item->code)->delete();
                item::where('id', $item->id)->delete();
           }
       }
         commission::where('category_id', $delcategory->id)->delete();
           $delcategory->delete();
        }
       
        session()->flash('success','تم حذف القسم بنجاح');
        return back();   
    }

    public function deleteAll(Request $request)
    {
        $ids    = $request->ids;
        $categories = DB::table("cuttings")->whereIn('id',explode(",",$ids))->get();
        foreach($categories as $category)
        {
            item::where('category_id', $delcategory->id)->delete();
         commission::where('category_id', $delcategory->id)->delete();
            $category->delete();
        }
        return response()->json(['success'=>"تم الحذف بنجاح"]);
    }
}
