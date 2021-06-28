@extends('layout.nav')
@section('script')
<script src="{{ asset('js/register.js') }}" defer></script>
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
<main id = 'reg_log'>
        <section class="main_left">
        </section>
        <section class="main_right">
            <h1>Registrati qui</h1>
            <form name='signup' method='post' enctype="multipart/form-data" autocomplete="off" action="{{ route('register') }}">
            @csrf
                <div class="names">
                    <div class="name">
                        <div><label for='name'>Nome</label></div>
                        <div><input type='text' name='nome' class = 'nome'></div>
                        <span class = 'nome_err err'></span>
                    </div>
                    <div class="surname">
                        <div><label for='surname'>Cognome</label></div>
                        <div><input type='text' name='cognome' class ='cognome'></div>
                        <span class = 'cognome_err err'></span>
                    </div>
                </div>
                <div class="email">
                    <div><label for='email'>Email</label></div>
                    <div><input type='text' name='email' class = 'email'></div>
                    <span class = 'email_err err'></span>
                </div>
                <div class="username">
                    <div><label for='username'>Nome utente</label></div>
                    <div><input type='text' name='username' class = 'username'></div>
                    <span class = 'username_err err'></span>
                </div>
                
                <div class="password">
                    <div><label for='password'>Password</label></div>
                    <div><input type='password' name='password' class = 'password'>
                         <input type="button" onclick= "showPwd()" value='' id = 'showpw'>
                    </div>
                    <span class = 'password_err err'></span>
                </div>
                <div class="data_nascita">
                    <div><label for='date'>Data nascita</label></div>
                    <div><input type = 'date' name = 'data' class = 'data'></div>
                    <span class = 'data_err err'></span>
                </div>
                <div class="tipologia">
                    <div><label for='tipo'>Tipologia</label></div>
                    <div><select id='selezione' name="tipologia" class = 'tipo'>
                          <option value="pilota" selected="selected">pilota  </option>
                          <option value="copilota">copilota  </option>
                    </select></div>
                    <span class = 'data_err err'></span>
                </div>
                <div class="allow"> 
                    <div><label for='allow'><input type='checkbox' name='allow' value="1">
                    Acconsento al trattamento dei dati personali</label></div>
                    <span class = 'check_err err'></span>
                </div>
                <div class="submit">
                    <input type='submit' value="Registrati" id="submit" disabled>
                </div>
            </form>
            <div class="signup">Hai un account? <a class="but_log" href="{{ route('login') }}">Accedi</a>
        </section>
        </main>
        @endsection