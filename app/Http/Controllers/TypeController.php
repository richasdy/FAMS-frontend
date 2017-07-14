<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BTPAsset;

class TypeController extends Controller
{
    //
    protected $APIAsset;

    public function __construct(BTPAsset $BTPAsset){
      $this->APIAsset=$BTPAsset;
    }

    public function tableType(Request $request){
      $page = 1;
      if($request->page){
        $page = $request->page;
      }
      $data = $this->APIAsset->get('index-type?page='.$page);
      //$ref = $this->APIAsset->get('cu-page-location');
      //dd($data);
      return view('type-page.index',['types'=>$data->result]);
    }

    public function createType(Request $request){
      $request = $this->APIAsset->get('create-type',$request->all());
      if($request->status==200){

      }
      return redirect()->back();
    }

    public function deleteType(Request $request){
      $id_type = $request->id_type;
      $request = $this->APIAsset->get('delete-type/'.$id_type);
      if($request->status==200){

      }
      return redirect()->back();
    }
}
