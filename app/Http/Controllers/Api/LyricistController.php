<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NateRasul;
use App\Models\LyricistModel;
class LyricistController extends Controller
{
    public function Lyricist(){
       return LyricistModel::withCount('nateRasuls')->get();
    }

    public function get_by_lyricist_id($id){
       $poems  =  NateRasul::where(['lyricist'=>$id])->get();

       foreach ($poems as $poem) {
        $poem->lyrics = $this->extractFirstTwoPTags($poem->lyrics);
    }
      return $poems;

    }

    public function fetchLyricistBySearch(?String $value):array{
      if($value !==null || !empty($value)){
      return  LyricistModel::where('name', 'like', '%' . $value . '%')->withCount('nateRasuls')->get()->toArray();
      }else{
        return [];
      }
    }
}
