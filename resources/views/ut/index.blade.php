@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h2 class="mb-0">Tanösvények</h2>
  <a href="{{ route('utak.create') }}" class="btn btn-success">Új</a>
</div>
<div class="table-responsive">
<table class="table table-hover align-middle">
  <thead><tr><th>Név</th><th>Település</th><th>NP</th><th>Hossz</th><th>Állomás</th><th>Idő</th><th>Vezetett</th><th></th></tr></thead>
  <tbody>
    @foreach($utak as $u)
    <tr>
      <td><a href="{{ route('utak.show', $u) }}">{{ $u->nev }}</a></td>
      <td>{{ $u->telepules->nev ?? '-' }}</td>
      <td>{{ $u->telepules->np->nev ?? '-' }}</td>
      <td>{{ $u->hossz }}</td>
      <td>{{ $u->allomas }}</td>
      <td>{{ $u->ido }}</td>
      <td>{{ $u->vezetes ? 'Igen' : 'Nem' }}</td>
      <td class="text-end">
        <a class="btn btn-sm btn-primary" href="{{ route('utak.edit', $u) }}">Szerk.</a>
        <form method="post" action="{{ route('utak.destroy', $u) }}" class="d-inline">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-danger" onclick="return confirm('Biztos törlöd?')">Törlés</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
{{ $utak->links() }}
@endsection
