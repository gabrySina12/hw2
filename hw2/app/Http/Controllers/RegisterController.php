<?php

use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\copilota;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller {

    public function checklog() {
        $session_p = session('pilota_id');
        $session_c = session('copilota_id');
                
        if ($session_p !== null){
            $user = User::find($session_p);
            return view("member")->with('user',$user);
        }elseif($session_c !== null){
            $copilota = copilota::find($session_c);
            return view("member")->with('copilota',$copilota);
        }else{
            return view('login');
        }
     }

    protected function create()
    {
        $request = request();
        $data = $request->only('nome', 'cognome', 'email', 'username', 'password', 'data');
        $type = $request->only('tipologia');

        if($type['tipologia'] === 'pilota'){
            $user = User::create([
                'nome' => $data['nome'],
                'cognome' => $data['cognome'],
                'data_nascita' => $data['data'],
                'email' => $data['email'],
                'username' => $data['username'],
                'password' => Hash::make($data['password']),
            ]);
            return redirect('login');

        }elseif ($type['tipologia'] === 'copilota'){
            $copilota = copilota::create([
                'nome' => $data['nome'],
                'cognome' => $data['cognome'],
                'data_nascita' => $data['data'],
                'email' => $data['email'],
                'username' => $data['username'],
                'password' => Hash::make($data['password']),
            ]);
            return redirect('login');

        }
    }

    public function checkUsername($query) {
        $exist = User::where('username', $query)->exists();
        return ['exists' => $exist];
    }
    public function checkEmail($query) {
        $exist = pilota::where('email', $query)->exists();
        return ['exists' => $exist];
    }

    public function view() {
        return view('register');
    }

}
?>