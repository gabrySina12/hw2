<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>WRC</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <script src="{{ asset('js/menu.js') }}" defer></script>  
    <link rel="icon" type="image/png" href="{{ asset('Immagini/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kurale&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Permanent+Marker&display=swap" rel="stylesheet">
    @routes
    @yield('script')
  </head>
  <body>
    <header>
    <nav id = "mobile">
    <div id = 'tendina' class = 'hidden'>
      <a id='close'>
        <img src = 'Immagini/Back.png'>
      </a>
      <a href="{{ route('home') }}">Home</a>
      <a href="{{ route('news') }}">News</a>
      <a href="{{ route('video') }}">Video</a>
    </div>
    <a id="menu">
      <div></div>
      <div></div>
      <div></div>
    </a>
    <div class= logo>
      <img src="Immagini/logo.png"/>
    </div>
    <div id = "signin" >
      @yield('user')
  </div>
  </nav>
  @yield('nav')
  </header>
    @yield('contenent')
    <footer>
    <div id = flex>
      <img class= "youtube" src="Immagini/yt.png"/>
    
    
      <img class= "instagram" src="Immagini/insta.png"/>
    
   
      <img class= "facebook" src="Immagini/fb.png"/>
    </div>
    <div id = nome>
      <a>Gabriele Sinatra</a>
      <p>Matricola: O46002283</p>
    </div>
    
  </footer>
  </body>
</html>