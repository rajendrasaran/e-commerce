<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  @include('include.head')
  @yield('style')
</head>

<body>
  <div class="hero_area">
    @include('include.header')

    @yield('page_content')
    <!-- end client section -->

    <!-- info section -->
    @yield('script')
    @include('include.footer')

</body>

</html>