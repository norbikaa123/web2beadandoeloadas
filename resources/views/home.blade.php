@extends('layouts.app')
@section('content')
<div class="p-4 p-md-5 mb-4 bg-light rounded-3">
  <div class="container-fluid py-5">
    <h1 class="display-5 fw-bold">Tanösvény katalógus</h1>
    <p class="col-md-8 fs-5">Fedezd fel Magyarország tanösvényeit nemzeti parkok szerint, böngéssz települések és útvonalak között!</p>
    <a class="btn btn-primary btn-lg" href="{{ route('db.index') }}">Kezdés</a>
  </div>
</div>
@endsection
