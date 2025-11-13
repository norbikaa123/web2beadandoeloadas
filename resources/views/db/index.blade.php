@extends('layouts.app')
@section('content')
<h2 class="mb-3">Nemzeti parkok &rarr; települések &rarr; tanösvények</h2>
@foreach($parks as $np)
  <div class="card mb-3">
    <div class="card-header fw-bold">{{ $np->nev }}</div>
    <div class="card-body">
      @if($np->telepulesek->isEmpty())
        <p class="text-muted">Nincs település adat.</p>
      @else
        @foreach($np->telepulesek as $t)
          <h6 class="mt-2">{{ $t->nev }}</h6>
          @if($t->utak->isEmpty())
            <p class="text-muted">Nincs tanösvény.</p>
          @else
            <div class="table-responsive">
            <table class="table table-sm align-middle">
              <thead><tr><th>Név</th><th>Hossz (km)</th><th>Állomás</th><th>Idő (óra)</th><th>Vezetett</th></tr></thead>
              <tbody>
                @foreach($t->utak as $u)
                  <tr>
                    <td>{{ $u->nev }}</td>
                    <td>{{ $u->hossz }}</td>
                    <td>{{ $u->allomas }}</td>
                    <td>{{ $u->ido }}</td>
                    <td>{{ $u->vezetes ? 'Igen' : 'Nem' }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            </div>
          @endif
        @endforeach
      @endif
    </div>
  </div>
@endforeach
@endsection
