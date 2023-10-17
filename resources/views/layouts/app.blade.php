<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Space') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<script>
$(document).ready(function () {
    document.getElementsByClassName('overlayFavouriteList')[0].style.visibility = 'hidden';
    document.getElementById('check_user_is_sure_to_delete').style.visibility = 'hidden';
    document.getElementById('user_input_choose_favourite_list_to_delete').style.visibility = 'hidden';

    const myDiv = document.querySelector('#return');
    myDiv.addEventListener('dblclick', function() {
        document.getElementsByClassName('overlayFavouriteList')[0].style.visibility = 'hidden';
    });
});

function Favourite(i, g) {
    document.getElementsByClassName('overlayFavouriteList')[0].style.visibility = 'visible';
    document.getElementById("my").value = i;
    document.getElementById("myg").value = g;
   // alert(i);
   // alert(document.getElementById("my").value);
}
</script>
<style>
body {
    background: url('https://images4.alphacoders.com/111/1114912.jpg');
    background-size: cover;
    margin-left: 50px;
    margin-right: 50px;
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;
}

body::-webkit-scrollbar {
    display: none;
}

.background-container{
    max-width: 1400px;
    margin-left: auto !important;
    margin-right: auto !important;
}

.dark-container {
    background: rgba(0, 0, 0, .5);
}

@media only screen and (max-width: 1500px) {
    .text-container {
        margin-left: 48px !important;
    }
}

input[type=text] { 
    background: transparent; 
    border: none;
}

::-webkit-input-placeholder { /* WebKit, Blink, Edge */
    color:    white !important;
}
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
   color:    white !important;
   opacity:  1;
}
::-moz-placeholder { /* Mozilla Firefox 19+ */
   color:    white !important;
   opacity:  1;
}
:-ms-input-placeholder { /* Internet Explorer 10-11 */
   color:    white !important;
}
::-ms-input-placeholder { /* Microsoft Edge */
   color:    white !important;
}

::placeholder { /* Most modern browsers support this now. */
   color:    white !important;
}

.yt-iframe-desktop {
    position: relative;
    width: 100%;
    height: 0;
    padding-bottom: 236px;;
}

.yt-iframe-phone {
    position: relative;
    width: 100%;
    height: 0;
    padding-bottom: 236px;;
    display: none;
    margin-top: 20px;
    margin-left: auto;
    margin-right: auto;
}

.fixed_size_padding{
    height: 100px;
    width: 100%;
    overflow: scroll;
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;
}

.overflow-hide {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;
}

.overflow-hide::-webkit-scrollbar {
    display: none;
}

.fixed_size_padding::-webkit-scrollbar {
    display: none;
}

.header-image{
    width:100%;
    height:60px;
    max-width: 140px;
}


@media only screen and (max-width: 700px) {
    .yt-iframe-phone {
        display:block;
    }
    .yt-iframe-desktop {
        display: none;
    }
    .background-container {
        padding: 20px !important;
        margin: 0px !important;
    }
    body {
        padding: 5px !important;
        margin-left: 0px !important;
        margin-right: 0px !important;
    }
    .h1-title {
        font-size: 15px;
    }
    .h2-title {
        font-size: 10px;
    }
    .form-control {
        margin-bottom: -15px;
    }
}

.yt-video {
    position: absolute;
    top: 0;
    left: 0;
    max-width: 420px;
    max-height: 236px;
    width: 100%;
    height: 100%;
    border-radius: 0px
}

.overlayFavouriteList{
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 10;
  background-color: rgba(0,0,0,0.7); 
}

.margin-auto {
    margin-left: auto !important;
    margin-right: auto !important;
}

.favourite-container {
    width: 700px;
    max-width: 700px;
    height: 85%;
    max-height: 85%;
}

.fixed-height {
    height: 100%;
    min-width: 270px;
}

.bg-opacity {
    background-color: rgba(0,0,0,0.4); 
}

.item-align-p {
    display: flex;
}



</style>
<body>
    <div id="app">
        <nav class="navbar">
            <div class="text-container container">
                 <!-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a> -->
                <div class="manual-padding" style="padding-top: 21px; margin-left: -60px; margin-bottom: 0px;">
                <img src="{{asset('images/logo2.png')}}" alt="Space Music" class="header-image">
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
