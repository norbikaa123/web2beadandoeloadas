<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller {
    public function index(){
        // Tanösvények száma NP-nként
        $rows = DB::table('np as n')
            ->leftJoin('telepules as t','t.npid','=','n.id')
            ->leftJoin('ut as u','u.telepulesid','=','t.id')
            ->selectRaw('n.nev as label, count(u.id) as value')
            ->groupBy('n.id','n.nev')
            ->orderBy('n.nev')
            ->get();
        return view('chart.index', ['rows'=>$rows]);
    }
}
