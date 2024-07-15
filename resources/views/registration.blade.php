@extends('layout')
@section('title', 'Register')
@section('content')
<div class="container-fluid">
    <form action="{{route('registration.post')}}" method="POST" class="mx-auto">
        @csrf
        <h4 class="text-center my-3 text-white">SIGN UP</h4>
        {{-- Email --}}
        <div class="mt-3 mb-4">
        <input type="email" class="form-control rounded-pill ps-3" name="email" placeholder="E-MAIL">
        @error('email')
            <div class="failed">*email harus diisi</div>
        @enderror
        </div>
        {{-- Nama --}}
        <div class="mb-4">
          <input type="text" class="form-control rounded-pill ps-3" name="name" placeholder="USERNAME">
        @error('name')
            <div class="failed">*nama harus diisi</div>
        @enderror
        </div>
        {{-- Password --}}
        <div class="mb-4">
            <input type="password" class="form-control rounded-pill ps-3" name="password" placeholder="PASSWORD">
        @error('password')
            <div class="failed">*password harus diisi</div>
        @enderror
        </div>
      <button type="submit" class="btn btn-outline-light rounded-pill mb-3">SIGN UP</button>
    </form>
</div>
@endsection
