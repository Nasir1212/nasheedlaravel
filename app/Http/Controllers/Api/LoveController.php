<?php
namespace App\Http\Controllers\Api;

use App\Models\NasheedLove;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NateRasul;
use App\Models\LyricistModel;
class LoveController extends Controller
{
    // Store love reaction
    public function loveNasheed(Request $request)
    {      
       // Check if the user already loved this nasheed
        $love = NasheedLove::where('user_id', $request->user_id)
                           ->where('nasheed_id', $request->nasheed_id)
                           ->first();

        if (!$love) {
             // Save love reaction
                NasheedLove::create([
                    'user_id' => $request->user_id,
                    'nasheed_id' => $request->nasheed_id
               ]);
         return response()->json(['message' => 'Nasheed loved successfully'], 201);

        }
        return response()->json(['message' => 'Already loved this Nasheed'], 409);
    }

    // Count loves for a nasheed
    public function countLoves($nasheed_id)
    {
        $count = NasheedLove::where('nasheed_id', $nasheed_id)->count();
        return response()->json(['count' => $count]);
    }

    public function checkLove(Request $request)
    {
        $love = NasheedLove::where('user_id', $request->user_id)
                           ->where('nasheed_id', $request->nasheed_id)
                           ->first();
        if($love){
            return response()->json(['loved' => true]);
        }else{
            return response()->json(['loved' => false]);
        }
    }

    // Remove love reaction
    public function removeLove(Request $request)
    {
        $love = NasheedLove::where('user_id', $request->user_id)
                           ->where('nasheed_id', $request->nasheed_id)
                           ->first();
             if($love){
                NasheedLove::where('user_id', $request->user_id)
                ->where('nasheed_id', $request->nasheed_id)
                ->delete();
                return response()->json(['message' => 'Love removed successfully']);
             }    
   
             return response()->json(['message' => 'Love was removed']);
    }

}
