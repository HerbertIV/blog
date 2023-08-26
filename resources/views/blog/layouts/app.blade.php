<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('blog.layouts.head')
<body>
@include('blog.components.navbar')
@include('blog.components.header')

<!-- Main Content-->
@yield('content')
@include('blog.layouts.tail')
</body>
</html>
