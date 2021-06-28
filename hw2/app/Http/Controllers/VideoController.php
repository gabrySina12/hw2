<?php

use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\copilota;
use App\Models\video;

class VideoController extends Controller {

    public function video() {
        $session_p = session('pilota_id');
        $session_c = session('copilota_id');
        
        
        if ($session_p !== null){
            $user = User::find($session_p);
            return view("video")->with('user',$user);
        }elseif($session_c !== null){
            $copilota = copilota::find($session_c);
            return view("video")->with('copilota',$copilota);
        }else{
            return view('video');
        } 
    }

    public function carousel(){
        return video::all();
    }
}
?>