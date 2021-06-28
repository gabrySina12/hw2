@extends('layout.nav')
@section('script')
<link rel="stylesheet" href="{{ asset('css/member.css') }}">
<script src="{{ asset('js/member.js') }}" defer></script> 
@endsection
@section('user')
@php $nome="" @endphp
@if(isset($user))
@php $nome .= "{$user['nome']['0']}" @endphp
@php $nome .= "{$user['cognome']['0']}" @endphp
@php $nom = "{$user['nome']}" @endphp
@php $cognom = "{$user['cognome']}" @endphp
@php $email = "{$user['email']}" @endphp
<div class = 'avatar__bar'><a href="{{ route('member') }}" class = 'icon__bar'><div class = 'avatar__text_bar'>{{$nome}} </div> </a> </div>
<form method="POST" action="{{ route('logout') }}" class="button">
                            @csrf
                           <button type="submit">Logout</button>
                        </form>

    @elseif(Isset($copilota))
    @php $nome .= "{$copilota['nome']['0']}" @endphp
    @php $nome .= "{$copilota['cognome']['0']}" @endphp
    @php $nom = "{$copilota['nome']}" @endphp
    @php $cognom = "{$copilota['cognome']}" @endphp
    @php $email = "{$copilota['email']}" @endphp
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
<div class = 'sidebar-view'>
        <div class = 'sidebar'>
                    <div class = 'sidebar_header'>
                      <div class = 'avatar'>

                            <div class = 'avatar__text'>
                                {{$nome}}
                            </div>
                      </div>
                        <h1 class = 'sidebar__heading'>{{$nom}} {{$cognom}}</h1>
                        <h2 class = 'sidebar__subheading'>{{$email}}</h2>

                    </div>
                  <div class = 'nav--vertical'>
                      <a id = 'gSquadra_but' class = 'nav__item active'>
                        <span class = 'nav__icon'>
                          <img src = 'Immagini/team.png'>
                        </span>
                        <span class = 'nav__text'>
                          Gestione squadra
                        </span>
                      </a>
                      <a id = 'favorite_but' class = 'nav__item'>
                        <span class = 'nav__icon'>
                          <img src = 'Immagini/favorite.png'>
                        </span>
                        <span class = 'nav__text'>
                          Preferiti
                        </span>
                      </a>
                      <a id='option_but' class = 'nav__item'>
                        <span class = 'nav__icon'>
                          <img src = 'Immagini/option.png'>
                        </span>
                        <span class = 'nav__text'>
                          Profilo
                        </span>
                      </a>
                   </div> 
      </div>
      <div id = 'option' class ='sidebar-view__content'>
          <div class = 'setting'>
          <div class="sidebar-view__header desktop__header">
                <h1 class="sidebar-view__heading">Informazioni profilo</h1>
                </div>
                <div class="sidebar-view__inner">
                  <div class="row__label">Nome</div>
                  <div class='row__content'>{{$nom}} {{$cognom}}</div>  

                  <div class="row__label">Email</div> 
                    <div class='row__content'>{{$email}}</div>  
                  <div>
                    <div class="row__label"><span>Password</span>

                  </div>
                  <div class="row__content">********</div>
                </div>
              </div>
          </div>
      </div>

      <div id = 'favorite' class ='sidebar-view__content'>
            <div class="sidebar-view__header desktop__header">
                  <h1 class="sidebar-view__heading">Eventi</h1>
            </div>
              <div id = 'fav_items' class="sidebar-view__inner">
              
              </div>
      </div>

      <div id = 'gSquadra' class ='sidebar-view__content'>
      <div class = 'setting'>
          <div class="sidebar-view__header desktop__header">
                <h1 class="sidebar-view__heading">Gestione squadra</h1>
          </div>
          <div class="sidebar-view__inner">
          <div id = 'sezTeam' class="row__label">
          <h2>La tua squadra</h2>
          <div id = 'my_teams' class = 'profile'>
          </div>
          </div>
          <h2>Vuoi creare una squadra? Inserisci il nome</h2>
            <div class='row__content'>
            <div id = 'new__team'>
              <input type='text' name ='squadra' placeholder="es. Hyundai" class ='my_team newT' autocomplete = 'off' >
            </div>
            <div><img src='Immagini/check.gif' alt ='check img' class = 'gif hidden'></div>
            <span class = 'squadra_err'></span>
            </div>
            
            <h2>Entra in una squadra</h2>
            
            <div class = 'team_lable'>
            <form>
              <label for="Team">Scegli una squadra:</label>
              <select name="Teams" class="team_lable select">
              </select>
              <input type="submit" value="Submit" class='my_sub send'>
            </form>
            <span class = 'squadra_err form'></span>
            </div>
            <h2>Inserisci l'evento di cui vuoi sapere quante squadre sono iscritte</h2>
            <div class = 'team_lable' class = 'contaSq'>
              <input type='text' name ='squadra' placeholder="es. W.R.C" id='conta' class='my_team' autocomplete = 'off'>
              <span class = 'squadra_err p4'></span>
              <div class = "row__labels">
                  <span class ='proce'>
                  </span>
              </div>
                  <h2>Lascia squadra</h2>
                  <input type='submit' class='my_sub leave showTeam' value='Lascia squadra'>
                  <span class = 'squadra_err leave1'></span>
                  </div>
                  
            </div>

          </div>
        </div>
      </div>
      @endsection