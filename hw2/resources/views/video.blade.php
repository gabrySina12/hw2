@extends('layout.nav')
@section('script')
<script src="{{ asset('js/video.js') }}" defer="true"></script>
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
<section id = 'carouselVid'>


  <div id = 'divDot'>

  </div>

</section>

<section>
    <div id = 'TitoloSearch'>
        <img src ="Immagini/syt.png">
        <h1>Altri video:</h1>
    </div>
    <div id = 'sezVideo'>
        <iframe width="319" height="180" src="https://www.youtube.com/embed/KZHD5pNX23s" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <iframe width="319" height="180" src="https://www.youtube.com/embed/q7wQVMDSEdY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <iframe width="319" height="180" src="https://www.youtube.com/embed/ZQ7XIGVCwsA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <iframe width="319" height="180" src="https://www.youtube.com/embed/sThNj8LUTxU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <iframe width="319" height="180" src="https://www.youtube.com/embed/VI1uySQbD4w" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <iframe width="319" height="180" src="https://www.youtube.com/embed/0X5kxMSeEyE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <iframe width="319" height="180" src="https://www.youtube.com/embed/kAocFo_4tMI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</section>
@endsection