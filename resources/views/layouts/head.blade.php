<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title')</title>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

<link rel="shortcut icon" type="image/png" href="{{ asset('icon/favicon.png') }}"/>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@if (Request::is('events'))
    <script src="{{ asset('js/scriptAdvancedSearch.js') }}" defer></script>
@elseif(Request::is('friends'))
    <script src="{{ asset('js/searchFriends.js') }}" defer></script>
@elseif(Request::is('searchMembers'))
    <script src="{{ asset('js/searchMembers.js') }}" defer></script>
@elseif(Request::is('communitySearch'))
    <script src="{{ asset('js/communitySearch.js') }}" defer></script>
@else
    <script src="{{ asset('js/scriptSearch.js') }}" defer></script>
@endif


<!-- Bootstrap -->
<link  type="text/css" href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- FontAwesome -->
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<!-- GoogleImports -->
<link href="https://fonts.googleapis.com/css?family=Salsa" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<link type="text/css" href="{{asset('timeline/css/style.css')}}" rel="stylesheet">
<link type="text/css" href="{{asset('css/searchNavBar.css')}}" rel="stylesheet">
{{--<link href="{{asset('timeline/scss/style.scss')}}" rel="stylesheet">--}}

@yield('extraScript')




