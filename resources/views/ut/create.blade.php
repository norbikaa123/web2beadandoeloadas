@extends('layouts.app')
@section('content')
<h2 class="mb-3">Új tanösvény</h2>
<form method="post" action="{{ route('utak.store') }}" class="row g-3">
  @csrf
  @include('ut.form')
  <div class="col-12"><button class="btn btn-success">Mentés</button></div>
</form>
@endsection
