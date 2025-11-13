@extends('layouts.app')
@section('content')
@if(auth()->user()->role!=='admin') @php(abort(403)) @endif
<h2 class="mb-3">Admin – Felhasználók</h2>
<div class="table-responsive">
<table class="table table-striped align-middle">
  <thead><tr><th>#</th><th>Név</th><th>E-mail</th><th>Szerep</th><th>Művelet</th></tr></thead>
  <tbody>
  @foreach($users as $u)
    <tr>
      <td>{{ $u->id }}</td>
      <td>{{ $u->name }}</td>
      <td>{{ $u->email }}</td>
      <td><span class="badge bg-{{ $u->role==='admin'?'danger':'secondary' }}">{{ $u->role }}</span></td>
      <td>
        <form method="post" action="{{ route('admin.users.role', $u) }}">
          @csrf @method('PATCH')
          <select name="role" class="form-select form-select-sm d-inline w-auto">
            <option value="registered" {{ $u->role==='registered'?'selected':'' }}>registered</option>
            <option value="admin" {{ $u->role==='admin'?'selected':'' }}>admin</option>
          </select>
          <button class="btn btn-sm btn-primary">Mentés</button>
        </form>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
</div>
{{ $users->links() }}
@endsection
