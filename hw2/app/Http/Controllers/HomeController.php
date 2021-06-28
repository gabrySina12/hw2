<?php

use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\copilota;

class HomeController extends Controller {

    public function home() {
        $session_p = session('pilota_id');
        $session_c = session('copilota_id');
        
        
        if ($session_p !== null){
            $user = User::find($session_p);
            return view("home")->with('user',$user);
        }elseif($session_c !== null){
            $copilota = copilota::find($session_c);
            return view("home")->with('copilota',$copilota);
        }else{
            return view('home');
        }
            
        
        
    }
}
?>