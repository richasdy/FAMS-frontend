<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BTPAsset;

class SearchController extends Controller
{
    //
    protected $APIAsset;

    public function __construct(BTPAsset $BTPAsset){
      $this->APIAsset=$BTPAsset;
    }

    public function search(Request $request){
      $query = $request['query'];
      $hitAPI = $this->APIAsset->get('search?q='.$query);
      dd($hitAPI->result);
    }
}
