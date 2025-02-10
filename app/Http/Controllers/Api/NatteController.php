<?php

namespace App\Http\Controllers\Api;
use App\Models\NateRasul;
use App\Models\LyricistModel;
use App\Models\VideoLink;
use App\Models\NasheedView;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NatteController extends Controller
{
    public function getAllNatte(){
        $poems = DB::select("SELECT nate_rasul.id, nate_rasul.title,nate_rasul.lyrics, lyricist.name
FROM nate_rasul
LEFT JOIN lyricist ON nate_rasul.lyricist= lyricist.id LIMIT 10;
");
        foreach ($poems as $poem) {
            $poem->lyrics = $this->extractFirstTwoPTags($poem->lyrics);
        }
          return $poems;
    }

    public function getOneNatte(Request $request,$id){
    //   return  NateRasul::find($id);

    $ip = $request->ip();
    $userAgent = $request->header('User-Agent');

    // Check if this user has already viewed it
    $existingView = NasheedView::where('nasheed_id', $id)
        ->where('ip_address', $ip)
        ->where('user_agent', $userAgent)
        ->first();

    if (!$existingView) {
        NasheedView::create([
            'nasheed_id' => $id,
            'ip_address' => $ip,
            'user_agent' => $userAgent
        ]);
    }


   return DB::select("SELECT nate_rasul.id, nate_rasul.title,nate_rasul.lyrics, lyricist.name
    FROM nate_rasul
    LEFT JOIN lyricist ON nate_rasul.lyricist= lyricist.id WHERE  nate_rasul.id ='$id';
    ");

    }

    public function getByLyricist($id){
       return  DB::select("SELECT nate_rasul.id, nate_rasul.title,nate_rasul.lyrics, lyricist.name
FROM nate_rasul
LEFT JOIN lyricist ON nate_rasul.lyricist= lyricist.id WHERE nate_rasul.lyricist ='$id' LIMIT 10;
");
    }


    public function fetchLyricsBySearch(?String $value):array{
            if($value !==null || !empty($value)){
                $results = NateRasul::where('lyrics', 'like', '%' . $value . '%')
               ->orWhere('title', 'like', '%' . $value . '%')
               ->get()
               ->toArray();

                // Remove HTML tags from the lyrics field
        foreach ($results as &$result) {
            if (isset($result['lyrics'])) {
                $result['lyrics'] = strip_tags($result['lyrics']);
            }
        }

        return $results;
            }else{
                return [];
            }

             
    }

    public function fetch_nasheed_link(?int $id):array{
        return VideoLink::where(['lyric_id'=>$id])->get()->toArray();
    }


    
}
