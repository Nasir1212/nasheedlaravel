<?php

namespace App\Http\Controllers\studio;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NateRasul;
use App\Models\LyricistModel;
use App\Models\VideoLink;
class studioController extends Controller
{
    public function dashboard(){
       
        return view('pages.studio.dashboard');
    }

    public function my_nasheed():View{
        $nasheeds = NateRasul::where(['lyricist'=>\Auth::guard('studio')->user()->id])->get();
        return view('pages.studio.my_nasheed',['nasheeds'=>$nasheeds]);
    }

    public function add_nasheed(){
        return view('pages.studio.add_nasheed');
    }

    public function store_nasheed(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'lyrics' => 'required',
            
            
        ]);
        NateRasul::create([
            'title' => $request->title,
            'lyrics' => $request->lyrics,
            'lyricist' => \Auth::guard('studio')->user()->id,
        ]);
        return back()->with(['success'=>'Successfully... Nasheed added!']);
    }

    public function edit_nasheed($id):View{
        $nasheed = NateRasul::findOrFail(decrypt($id));
        return view('pages.studio.edit_nasheed',['nasheed'=>$nasheed]);
    }

    public function update_nasheed(Request $request):RedirectResponse{
        $request->validate([
            'title' => 'required|string|max:255',
            'lyrics' => 'required',
            
            
        ]);
        NateRasul::where(['id'=>decrypt($request->id)])->update([
            'title' => $request->title,
            'lyrics' => $request->lyrics,
           
        ]);
        return back()->with(['success'=>'Successfully... Nasheed updated!']);
    }

    public function delete_nasheed($id):RedirectResponse{
        NateRasul::where(['id'=>decrypt($id)])->delete();
        return back()->with(['success'=>'Successfully... Nasheed Deleted!']);

    }

    public function show_nasheed($id){
        $nasheed = NateRasul::findOrFail(decrypt($id));

        return view('pages.studio.show_nasheed',['nasheed'=>$nasheed]);
    }

    public function add_vido_link(Request $request){
        
        $request->validate([
            'embed_link' => 'required|string|max:11', // Video ID is 11 characters long
        ]);
/**
 * here uploader_id type is 3 . like ad = admin , au = author , pu = public
 * 
 */
        VideoLink::create([
            'lyric_id'=>$request->nasheed_id,
            'link'=>$request->embed_link,
            'uploader_id'=>"au_".\Auth::guard('studio')->user()->id,
        ]);

       return back()->with('success','Successfully... Video Link added!');
    }

    public function delete_video(Request $request){
        VideoLink::where(['id'=>$request->id])->delete();
        return back()->with('success','Successfully... Video Link deleted!');
    }
}
