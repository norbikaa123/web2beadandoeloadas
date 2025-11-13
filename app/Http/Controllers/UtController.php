<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ut;
use App\Models\Telepules;

class UtController extends Controller
{
    /**
     * Útvonalak listázása
     */
    public function index()
    {
        $utak = Ut::with('telepules.np')
                    ->orderBy('nev')
                    ->paginate(20);

        return view('ut.index', compact('utak'));
    }

    /**
     * Új út létrehozó form
     */
    public function create()
    {
        $telepules = Telepules::with('np')
                              ->orderBy('nev')
                              ->get();

        return view('ut.create', compact('telepules'));
    }

    /**
     * Új út mentése adatbázisba
     */
    public function store(Request $request)
    {
        $request->validate([
            'nev' => 'required|string|max:255',
            'hossz' => 'required|numeric',
            'telepules_id' => 'required|exists:telepules,id',
        ]);

        Ut::create($request->all());

        return redirect()->route('utak.index')->with('success', 'Út sikeresen létrehozva.');
    }

    /**
     * Út szerkesztő form
     */
    public function edit(Ut $ut)
    {
        $telepules = Telepules::orderBy('nev')->get();

        return view('ut.edit', compact('ut', 'telepules'));
    }

    /**
     * Út frissítése
     */
    public function update(Request $request, Ut $ut)
    {
        $request->validate([
            'nev' => 'required|string|max:255',
            'hossz' => 'required|numeric',
            'telepules_id' => 'required|exists:telepules,id',
        ]);

        $ut->update($request->all());

        return redirect()->route('utak.index')->with('success', 'Út sikeresen frissítve.');
    }

    /**
     * Út törlése
     */
    public function destroy(Ut $ut)
    {
        $ut->delete();

        return redirect()->route('utak.index')->with('success', 'Út sikeresen törölve.');
    }
}
