<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @section('title')
        ReEvent
    @endsection

    @if(\Illuminate\Support\Facades\Auth::guest())
            @include('layouts.visitorHead')
    @endif
            @include('layouts.head')

    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
    @if(Auth::guest())
        @include('layouts.visitorNav')
    @else
        @include('layouts.nav')
        @include('layouts.searchNavBar')
    @endif

    @yield('afterNav')

    @yield('searchBody')

    <div class="container">
        <legend style="color: #333; padding: 1rem; margin-left: 0.5rem; padding-left: 0; padding-bottom: 0;">
            @yield('titleIcon')
            <span style="margin-left: .5rem;">
                    @yield('pageTitle')
            </span>
        </legend>

            <section id="content">
                @yield('content')
            </section>
    </div>

    @include('layouts.footer')
</body>
</html>
