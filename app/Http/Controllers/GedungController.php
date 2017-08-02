<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BTPAsset;

class GedungController extends Controller
{
    //
    protected $APIAsset;

    public function __construct(BTPAsset $BTPAsset){
      $this->APIAsset=$BTPAsset;
    }

    public function tableGedung(Request $request){
      $page = 1;
      if($request->page){
        $page = $request->page;
      }
      $data = $this->APIAsset->get('index-gedung?page='.$page);
      $ref = $this->APIAsset->get('cu-page-gedung');
      //dd($data);
      return view('gedung-page.index',['gedung'=>$data->result,'ref'=>$ref->result]);
    }

    public function createGedung(Request $request){
      $request = $this->APIAsset->get('create-gedung',$request->all());
      if($request->status==200){

      }
      return redirect()->back();
    }

    public function deleteGedung(Request $request){
      $id_gedung = $request->id_gedung;
      $request = $this->APIAsset->get('delete-gedung/'.$id_gedung);//sdd($request);
      if($request->status==200){

      }
      return redirect()->back();
    }
}
