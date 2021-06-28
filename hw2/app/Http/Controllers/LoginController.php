<?php

use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\copilota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller {


    public function login() {
        if(session('pilota_id') != null) {
            return redirect("home");
        }elseif(session('copilota_id') != null){
            return redirect("home");
        }
        else {
            return view('login')->with('csrf_token', csrf_token());
        }
     }

     public function checkLogin() {
         $request = request();
        $user = User::where('username', $request['username'])->first();
        
        $copilota = copilota::where('username', $request['username'])->first();
        

        if($user !== null) {
            if(Hash::check($request['password'], $user['password'])){
            Session::put('pilota_id', $user['id']);
            return redirect('member');
        }
        }elseif($copilota !== null){
            if(Hash::check($request['password'], $copilota['password'])){
                Session::put('copilota_id', $copilota["id"]);
                return redirect('member');
            
        }
        else {
            return view('login')->withInput();
        }

    }
}

    public function logout() {
        Session::flush();
        return redirect('login');
    }

}

?>