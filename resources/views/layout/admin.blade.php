<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')

    @yield('style')
</head>


<body>
    @include('includes.nav')


    @include('includes.header')
  
    @yield('page_content')
    @include('includes.script')
    @yield('script')
</body>
</html>