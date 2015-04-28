@include('components.header')

@include('components.nav-mobile')

@include('components.nav')

<div id="page-wrapper" >
    <div id="page-inner">

        @yield('content')

        @yield('charts')

    </div>
</div>

@yield('scripts')



@include('components.footer')