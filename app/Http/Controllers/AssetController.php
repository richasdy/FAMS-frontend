<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BTPAsset;

class AssetController extends Controller
{
    //
    protected $APIAsset;

    public function __construct(BTPAsset $BTPAsset){
      $this->APIAsset=$BTPAsset;
    }

    public function tableAsset(Request $request){
      $page = 1;
      if($request->page){
        $page = $request->page;
      }
      $data = $this->APIAsset->get('index-asset?page='.$page);
      $ref = $this->APIAsset->get('cu-page-asset');
      //dd($data);
      return view('asset-page.index',['assets'=>$data->result->data , 'ref'=>$ref->result]);
    }

    public function createAsset(Request $request){
     $request = $this->APIAsset->get('create-asset',$request->all());
     if($request->status==200){

     }
     return redirect()->back();
    }

    public function deleteAsset(Request $request){
      $idAsset = $request->id_asset;
      $request = $this->APIAsset->get('delete-asset/'.$idAsset);
      //dd($request);
      if($request->status==200){

      }
      return redirect()->back();
    }

}
