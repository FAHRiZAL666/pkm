@extends('layout')
@section('title', 'Login Admin')
@section('content')
<div class="container-fluid">
    <form action="{{route('admin.post')}}" method="POST" class="mx-auto">
        @csrf
        <h4 class="text-center my-3 text-white">LOG IN ADMIN</h4>
      <div class="mb-3 mt-5 mb-4">
        @if (session()->has('error'))
            <div class="failed">*email atau password salah</div>
        @endif
        {{-- @if (session()->has('success'))
            <div class="success">log in sukses</div>
        @endif --}}
        <input type="text" class="form-control rounded-pill ps-3" name="username" placeholder="USERNAME">
        @error('username')
            <div class="failed">*masukan email</div>
        @enderror
      </div>
      <div class="mb-4">
        <input type="password" class="form-control rounded-pill ps-3" name="password" placeholder="PASSWORD">
        @error('password')
            <div class="failed">*masukan password</div>
        @enderror
      </div>
          {{-- <a href="homePage.html" class="btn btn-light rounded-pill mb-5" role="button"> LOG IN</a> --}}
          <button type="submit" class="btn btn-outline-light rounded-pill mb-5">LOG IN</button>
    </form>
</div>
@endsection
