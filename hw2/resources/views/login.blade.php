@extends('layout.nav')
@section('script')
<link rel="stylesheet" href="{{ asset('css/log.css') }}">
@endsection
@section('user')
@php $nome="" @endphp
@if(isset($user))
@php $nome .= "{$user['nome']['0']}" @endphp
@php $nome .= "{$user['cognome']['0']}" @endphp
<div class = 'avatar__bar'><a href="{{ route('member') }}" class = 'icon__bar'><div class = 'avatar__text_bar'>{{$nome}} </div> </a> </div>
<form method="POST" action="{{ route('logout') }}" class="button">
                            @csrf
                           <button type="submit">Logout</button>
                        </form>

    @elseif(Isset($copilota))
    @php $nome .= "{$copilota['nome']['0']}" @endphp
    @php $nome .= "{$copilota['cognome']['0']}" @endphp
    <div class = 'avatar__bar'><a href="{{ route('member') }}" class = 'icon__bar'><div class = 'avatar__text_bar'>{{$nome}} </div> </a> </div>
                        <form method="POST" action="{{ route('logout') }}" class="button">
                            @csrf
                           <button type="submit">Logout</button>
                        </form>
        
    @else
        <a href="{{ route('login') }}">Login</a>
    @endif
@endsection
@section('contenent')
  <section id='boxLog'>
      <form name = "login" method="POST" id = 'login' action="{{ route('login') }}">
      @csrf
        <h1>Accedi o registrati!</h1>

        <span>Username</span>
        <input type='text' id='username' name='username' placeholder="es. mario.rossi12"></div>
                </div>
        <span>Password</span>
        <input type='password' id='password'name='password' placeholder="es. Password123"></div>
                </div>
        <input type='submit' id='bottonLog' value='Login'>


          <div class="logbut">Sei un pilota? <a class="but_reg" href="{{ route('register') }}">Registrati</a></div>
        </form>
      
  </section>
  @endsection