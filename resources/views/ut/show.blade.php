@extends('layouts.app')
@section('content')
<h2 class="mb-3">{{ $ut->nev }}</h2>
<ul class="list-group mb-3">
  <li class="list-group-item"><strong>Település:</strong> {{ $ut->telepules->nev ?? '-' }}</li>
  <li class="list-group-item"><strong>NP:</strong> {{ $ut->telepules->np->nev ?? '-' }}</li>
  <li class="list-group-item"><strong>Hossz:</strong> {{ $ut->hossz }} km</li>
  <li class="list-group-item"><strong>Állomás:</strong> {{ $ut->allomas }}</li>
  <li class="list-group-item"><strong>Idő:</strong> {{ $ut->ido }} óra</li>
  <li class="list-group-item"><strong>Vezetett:</strong> {{ $ut->vezetes ? 'Igen' : 'Nem' }}</li>
</ul>
<a href="{{ route('utak.index') }}" class="btn btn-secondary">Vissza</a>
@endsection
