<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @section('title')
        ReEvent
    @endsection
    @include('layouts.head')
</head>
<body>
    @if(Auth::guest())
        @include('layouts.visitorNav')
    @else
        @include('layouts.nav')
    @endif
    
    <div class="container">
        <legend style="color: #333; padding: 1rem; margin-left: 0.5rem; padding-left: 0; padding-bottom: 0;">
            @yield('titleIcon')
            <span style="margin-left: .5rem;">
                    @yield('pageTitle')
            </span>
        </legend>

        <div class="bs-docs-section" style="margin-left: .5rem; margin-right: .5rem; padding-top: 1rem; "{{--style="padding-bottom: -1em;"--}}>

            <section id="content">
                @yield('content')
            </section>
        </div>

        @include('layouts.footer')
    </div>
</body>
</html>
