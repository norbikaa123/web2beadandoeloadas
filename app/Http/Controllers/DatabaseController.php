<?php
namespace App\Http\Controllers;
use App\Models\Np;

class DatabaseController extends Controller {
    public function index(){
        $parks = Np::with(['telepulesek.utak'])->get();
        return view('db.index', compact('parks'));
    }
}
