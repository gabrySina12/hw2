<?php

use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\copilota;
use App\Models\evento;
use App\Models\preferiti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

class NewsController extends Controller {

  
        public function news() {
            $session_p = session('pilota_id');
            $session_c = session('copilota_id');
            
            
            if ($session_p !== null){
                $user = User::find($session_p);
                return view("news")->with('user', $user);
            }elseif($session_c !== null){
                $copilota = copilota::find($session_c);
                return view("news")->with('copilota', $copilota);
            }else{
                return view('news');
            }
        }

            function weather($query) {   
                $res = Http::get('http://api.weatherstack.com/current', [
                    'access_key' => env('WEATHER_APIKEY'),
                    'query' => $query
                ]);
                if ($res->failed()) abort(500);
                $newJson = array();
                
                    $newJson[] = array(
                        'weather_icons' => $res['current']['weather_icons']['0'], 'cloudcover' => $res['current']['cloudcover'], 'humidity' => $res['current']['humidity'], 'precip' => $res['current']['precip']
                    );
        
                    return response()->json($newJson);
            }

            function listaNews() {
                $news = evento::all();
                return $news;                 
            }

            function search($query) {
                $search = evento::where('nome', 'like', '%'.$query.'%')->get();
                return $search;                 
            }

            function favorite() {
                $session_p = session('pilota_id');
                $session_c = session('copilota_id');
                
                
                if ($session_p !== null){
                    $user = User::find($session_p);
                    $pref = preferiti::where('username','like', '%'.$user['username'].'%')->get();
                    return $pref;
                }elseif($session_c !== null){
                    $copilota = copilota::find($session_c);
                    $pref1 = preferiti::where('username', 'like', '%'.$copilota['username'].'%')->get();
                    return $pref1;
                }
            }

            function addFavorite($query) {
                $session_p = session('pilota_id');
                $session_c = session('copilota_id');
                $event = evento::where('nome','like', '%'.$query.'%')->first();
                
                
                    if ($session_p !== null){
                        $user = User::find($session_p);
                        $pref = preferiti::where('titolo', $query)->where('username', $user['username'])->first();
                        if($pref == null){
                        $add= preferiti::create([
                            'username' => $user['username'],
                            'titolo' => $event['nome'],
                            'link' => $event['link'],
                            'pic' => $event['pic'],
                            'descrizione' => $event['descrizione']
                        ]);
                        return ['exists' => true];

                    }
                    return ['exists' => false];

                }elseif($session_c !== null){
                        $copilota = copilota::find($session_c);
                        $pref = preferiti::where('titolo', $query)->where('username', $copilota['username'])->first();
                        if($pref == null){
                        $add = preferiti::create([
                            'username' => $copilota['username'],
                            'titolo' => $event['nome'],
                            'link' => $event['link'],
                            'pic' => $event['pic'],
                            'descrizione' => $event['descrizione']
                        ]);
                        return ['exists' => true];
                    }
                        return ['exists' => false];
                    }else{
                        return ['exists' => false];
                }
                }

            public function remove_pref($q){
                $session_p = session('pilota_id');
                $session_c = session('copilota_id');

                if ($session_p !== null){
                    $user = User::find($session_p);
                    $pref = preferiti::where('titolo', $q)->where('username', $user['username'])->delete();
                    return ['exists' => true];
                   
            }elseif($session_c !== null){
                $copilota = copilota::find($session_c);
                $pref = preferiti::where('titolo', $q)->where('username', $copilota['username'])->delete();
                return ['exists' => true];
                
            }else{
                return ['exists' => false];
            }
        }
        
    
    }
?>