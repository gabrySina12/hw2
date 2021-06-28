<?php

use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\copilota;
use App\Models\squadra;
use App\Models\preferiti;

class MemberController extends Controller {

    public function check() {
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

    public function checkTeam($query) {
        $session_p = session('pilota_id');
        $session_c = session('copilota_id');   
        if ($session_p !== null){
            $user = DB::table('pilota')->where('pilota.id', $session_p)->join('squadra', 'squadra', '=', 'squadra.id')->where('squadra', '1')->get();
            if(isset($user)){
                
                $squadra = squadra::where('nome', $query)->get();

                    return ['exists' => count($squadra) > 0 ? true : false];
                }else{
                    return ['exists' => true];
                }                
                        
        }elseif($session_c !== null){
            $copilota = DB::table('copilota')->where('copilota.id', $session_p)->join('squadra', 'squadra', '=', 'squadra.id')->where('squadra', '1')->get();
            if(isset($copilota)){
                $squadra = squadra::where('nome', $query)->get();

                    return ['exists' => count($squadra) > 0 ? true : false];
                }else{
                    return ['exists' => true];
                }
            
                }else{
                    return ['exists' => true];
                }
            
        }  
    

    public function createTeam($query) {
        $session_p = session('pilota_id');
        $session_c = session('copilota_id');           
        if ($session_p !== null){
            $user = DB::table('pilota')->where('pilota.id', $session_p)->join('squadra', 'squadra', '=', 'squadra.id')->where('squadra', '1')->get();
            if(count($user)>0){
                $squadra = squadra::where('nome', $query)->get();
                if(count($squadra)<1){
                    $create = squadra::create([
                        'nome' => $query
                    ]);
                  $user2 = User::find($session_p);
                  $user2->squadra = $create->id;
                  $user2->save();
                    return ['exists' => true];
                }else{
                    return ['exists' => false];
                } 
            }else{
                return ['exists' => false];
            }      
        }elseif($session_c !== null){
            $copilota = DB::table('copilota')->where('copilota.id', $session_c)->join('squadra', 'squadra', '=', 'squadra.id')->where('squadra', '1')->first();
            if($copilota){
                $squadra = squadra::where('nome', $query)->get();
                if(count($squadra)<1){
                    $create = squadra::create([
                        'nome' => $query
                    ]);
                  $copilota2 = copilota::find($session_c);
                  $copilota2->squadra = $create->id;
                  $copilota2->save();
                    return ['exists' => true];
                }else{
                    return ['exists' => false];
                }
            }else{
                return ['exists' => false];
            }
            
        }else{
            ['exists' => false];
        }  
    }

    public function teamList(){
        return squadra::all();
    }
    
    public function preferiti(){
        $session_p = session('pilota_id');
        $session_c = session('copilota_id');
        
            if ($session_p !== null){
                $user = User::find($session_p);
                return preferiti::where('username', $user['username'])->get();


        }elseif($session_c !== null){
            $copilota = copilota::find($session_c);
            return preferiti::where('username', $copilota['username'])->get();
        }
    
    }

    public function remove($q){
        $session_p = session('pilota_id');
        $session_c = session('copilota_id');
        
            if ($session_p !== null){
                $user = User::find($session_p);
                return preferiti::where('username', $user['username'])->where('titolo', $q)->delete();


        }elseif($session_c !== null){
            $copilota = copilota::find($session);
            return preferiti::where('username', $copilota['username'])->where('titolo', $q)->delete();
        }
    
    }

    public function infoTeam() {
        $session_p = session('pilota_id');
        $session_c = session('copilota_id');   
        if ($session_p !== null){
            $user = DB::table('pilota')->where('pilota.id', $session_p)->join('squadra', 'squadra', '=', 'squadra.id')->get();
            return $user;               
                        
        }elseif($session_c !== null){
            $copilota = DB::table('copilota')->where('copilota.id', $session_c)->join('squadra', 'squadra', '=', 'squadra.id')->get();
            return $copilota;
            
        } 

    }

    public function procedure4($q){
        return DB::select("call P4('$q')");
    }

    public function join($q) {
        $session_p = session('pilota_id');
        $session_c = session('copilota_id');
                
        if ($session_p !== null){
            $user = User::where('id',$session_p)->where('squadra', 1)->first();
            $squadra = squadra::where('nome', 'like', '%'.$q.'%')->first();
            if($user !== null){
                $user->squadra = $squadra->id;
                $user->save();
                return ['exists' => true,
                        'nome' => $q];
            }else{
                return ['exists' => false];
            }
            
        }elseif($session_c !== null){
            $copilota = copilota::where('id',$session_c)->where('squadra', 1)->first();
            $squadra = squadra::where('nome', 'like', '%'.$q.'%')->first();
            if($copilota !== null){
                $copilota['squadra'] = $squadra->id;
                $copilota->save();
                return ['exists' => true,
                        'nome' => $q];
            }else{
                return ['exists' => false];
            }
        }
    }

    public function leave(){
        $session_p = session('pilota_id');
        $session_c = session('copilota_id');
                
        if ($session_p !== null){
            $user = User::where('id',$session_p)->where('squadra', 1)->first();
            if($user == null){
                $user = User::find($session_p);
                $user->squadra = '1';
                $user->save();
                return ['exists' => true];
            }else{
                return ['exists' => false];
            }
            
        }elseif($session_c !== null){
            $copilota1 = copilota::where('id',$session_c)->where('squadra', 1)->first();
            if($copilota1 == null){
                $copilota = copilota::find($session_c);
                $copilota->squadra = '1';
                $copilota->save();
                return ['exists' => true];
            }else{
                return ['exists' => false];
            }
            
        }else{
            return ['exists' => false];
        }   
    }
}
?>