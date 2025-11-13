@extends('layouts.app')
@section('content')
<h2 class="mb-3">Tanösvény szerkesztése</h2>
<form method="post" action="{{ route('utak.update', $ut) }}" class="row g-3">
  @csrf @method('PUT')
  @include('ut.form')
  <div class="col-12"><button class="btn btn-primary">Frissítés</button></div>
</form>
@endsection
