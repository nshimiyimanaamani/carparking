<?php

namespace App\Http\Controllers;

use App\Models\parkingLocation;
use App\Models\parkingslots;
use Illuminate\Http\Request;

class ParkingplaceController extends Controller
{
    //
    public function index(){
      $parkings=[];
      $parkingss=parkingLocation::get();
      foreach($parkingss as $parking)
      {
        $parkingslots=parkingslots::where('location_id',$parking['id'])->count();
        $entities=[
          'id'=>$parking['id'],
          'name'=>$parking['name'],
          'Available_spot'=>$parking['Available_spot'],
          'Price_per_hourly'=>$parking['Price_per_hourly'],
          'parking_slots'=>$parkingslots,
          'status'=>$parking['status']
        ];
        array_push($parkings,$entities);

      }
      return view('admin.parkingplaces.show',compact('parkings'));
    }

    public function show(){

        return view('admin.parkingplaces.create');
      }

      public function create(Request $request){
        $create=parkingLocation::create([
          'name'=>$request->name,
          'Available_spot'=>$request->spots,
          'Price_per_hourly'=>$request->price
        ]);

        if($create)
        {
           $sweet=array('title'=>'Place Created successfully','message'=>'place is Created');
         return redirect()->back()->with('sweet',$sweet);
        }

       
      }
      public function showslots($id){

          $parkings=parkingLocation::where('id',$id)->first();
        return view('admin.parkingplaces.createSlot',compact('parkings'));
      }
      public function showslotsData($id){

      $parkings=parkingslots::where('location_id',$id)->get();
      $parkingLocation=parkingLocation::where('id',$id)->first();
      return view('admin.parkingplaces.showParkingSlosts',compact('parkings','parkingLocation'));
    }

      public function slotscreate(Request $request,$id)
      {
        $codes=$request->codes;
        $categories=$request->categories;
        $getlocation=parkingLocation::where('id',$id)->first();
        $countries = array_map(function ($codes, $categories) {
          return [
             "code" => $codes,
             'category'=>$categories
          ];
      }, $codes,$categories);
      
      $slots=collect($countries);
      foreach($slots as  $slot){
        // dd($slot['code']);
        $create=parkingslots::create([
          'code'=>$slot['code'],
          'category'=>$slot['category'],
          'location_id'=>$getlocation->id
        ]);
     

      }
      if($create)
      {
        $sweet=array('title'=>'Place Created successfully','message'=>'place is Created');
        return redirect()->back()->with('sweet',$sweet);
      }
      }
}
