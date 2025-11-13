@extends('layouts.app')
@section('content')
<h2 class="mb-3">Kapcsolat</h2>
<form method="post" action="{{ route('contact.store') }}" class="row g-3">
  @csrf
  <div class="col-md-6">
    <label class="form-label">Név</label>
    <input class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="col-md-6">
    <label class="form-label">E-mail</label>
    <input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="col-12">
    <label class="form-label">Üzenet</label>
    <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="5">{{ old('message') }}</textarea>
    @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="col-12">
    <button class="btn btn-primary">Küldés</button>
  </div>
</form>
@endsection
