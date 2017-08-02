<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BTPAsset;

class LocationController extends Controller
{
    //
    protected $APIAsset;

    public function __construct(BTPAsset $BTPAsset){
      $this->APIAsset=$BTPAsset;
    }

    public function tableLocation(Request $request){
      $page = 1;
      if($request->page){
        $page = $request->page;
      }
      $data = $this->APIAsset->get('index-location?page='.$page);
      $ref = $this->APIAsset->get('cu-page-location');
      //dd($data);
      return view('location-page.index',['locations'=>$data->result,'ref'=>$ref->result]);
    }

    public function createLocation(Request $request){
      $request = $this->APIAsset->get('create-location',$request->all());
      if($request->status==200){

      }
      return redirect()->back();
    }

    public function deleteLocation(Request $request){
      $id_location = $request->id_location;
      $request = $this->APIAsset->get('delete-location/'.$id_location);
      if($request->status==200){

      }
      return redirect()->back();
    }
}
