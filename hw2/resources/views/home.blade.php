@extends('layout.nav')
@section('script')
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
<section id = Prima>
    <nav id = intro>
      <h1>
        <em>season 2021</em><br/>
        <strong>rally championship</strong><br/>
      </h1>
      </nav>
  </section>

  <section id = seconda>
    <div class = "main">
      <p>“La cosa più bella che può fare un uomo vestito è guidare di traverso” - Miki Biasion</p>
      <img src="Immagini/porche.png" />
      </div>
    <div id="details">
      <div>
        <img src="Immagini/Rally22.jpg" />
        <div class = shadow>
        <h1>WRC artic</h1>
        <p>
          per la prima volta nella sua storia il WRC affronterà il rigore e le temperature 
          glaciali del Circolo Polare Artico: sono previsti 30° sotto lo zero brr...
        </p>
      </div>
      </div>
      <div>
        <img src="Immagini\Rally1.jpg" />
        <div class>
        <h1>WRC sardegna</h1>
        <p>
          inserita nel calendario del Campionato del mondo rally nel 2004 sostituendo il Rally 
          di Sanremo in qualità di tappa italiana del campionato mondiale              
        </p>
      </div>
      </div>
    </div>
  </section>
@endsection