@extends('layouts.app')
@section('content')
<h2 class="mb-3">Beérkezett üzenetek</h2>
<div class="table-responsive">
<table class="table table-striped align-middle">
  <thead><tr><th>#</th><th>Név</th><th>E-mail</th><th>Üzenet</th><th>Küldve</th></tr></thead>
  <tbody>
  @foreach($messages as $m)
    <tr>
      <td>{{ $m->id }}</td>
      <td>{{ $m->name }}</td>
      <td>{{ $m->email }}</td>
      <td style="max-width:480px">{{ Str::limit($m->message, 120) }}</td>
      <td>{{ $m->created_at }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
</div>
{{ $messages->links() }}
@endsection
