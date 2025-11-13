@extends('layouts.app')
@section('content')
<h2 class="mb-3">Tanösvények száma nemzeti parkonként</h2>
<canvas id="chart" height="120"></canvas>
<script>
document.addEventListener('DOMContentLoaded', function(){
  const labels = @json($rows->pluck('label'));
  const data = @json($rows->pluck('value'));
  new Chart(document.getElementById('chart'), {
    type: 'bar',
    data: { labels, datasets: [{ label: 'Tanösvények', data }] },
    options: { responsive: true, scales: { y: { beginAtZero: true } } }
  });
});
</script>
@endsection
