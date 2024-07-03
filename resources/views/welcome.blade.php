@extends('layout')
@section('title', 'welcome')
@section('content')
<div class="container-fluid">
    <form class="mx-auto">
      <h1 class="text-center my-3 text-white">WELCOME</h1>
      <a href="{{route('login')}}" class="btn btn-light rounded-pill btn-lg mb-4 mt-5" role="button"> LOG IN</a>
      <a href="{{route('registration')}}" class="btn btn-outline-light rounded-pill btn-lg mb-5" role="button">SIGN IN</a>
    </form>
</div>
@endsection
