<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BTPAsset;

class DashboardController extends Controller
{
    //
    protected $APIAsset;

    public function __construct(BTPAsset $BTPAsset){
      $this->APIAsset=$BTPAsset;
    }

    public function home(){
      $raw_data = $this->APIAsset->get('asset-simple-counter');
      $data = $raw_data->result;
      //dd($data);
      //cari jumlah asset per gedung
      return view('dashboard-page.home',['data'=>$data]);
    }

    public function counterAssetPerGedung($data){
      foreach($data->location as $gdg){
        $jml_asset = 0;
        foreach($gdg->ruangan as $ruangan){
          $jml_asset = $jml_asset+count($ruangan->assets);
        }
        var_dump($gdg);
      }
      return $data;
    }

    public function counterAssetPerType(){

    }
}
