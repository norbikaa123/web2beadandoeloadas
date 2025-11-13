<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\{Np,Telepules,Ut,User};

class DatabaseSeeder extends Seeder {
    public function run(): void {
        // NP-k (rövidített lista példa, bővítsd 10-re igény szerint)
        $nps = [
            ['nev'=>'Aggteleki Nemzeti Park Igazgatóság'],
            ['nev'=>'Balaton-felvidéki Nemzeti Park Igazgatóság'],
            ['nev'=>'Bükki Nemzeti Park Igazgatóság'],
            ['nev'=>'Duna–Dráva Nemzeti Park Igazgatóság'],
            ['nev'=>'Duna–Ipoly Nemzeti Park Igazgatóság'],
            ['nev'=>'Fertő–Hanság Nemzeti Park Igazgatóság'],
            ['nev'=>'Hortobágyi Nemzeti Park Igazgatóság'],
            ['nev'=>'Kiskunsági Nemzeti Park Igazgatóság'],
            ['nev'=>'Körös–Maros Nemzeti Park Igazgatóság'],
            ['nev'=>'Őrségi Nemzeti Park Igazgatóság'],
        ];
        foreach ($nps as $i => $np) {
            $park = Np::create($np);
            // minta település + út
            $t = Telepules::create(['nev'=>"Minta Település ".($i+1), 'npid'=>$park->id]);
            Ut::create(['nev'=>"Minta Tanösvény ".($i+1), 'hossz'=>2.5, 'allomas'=>8, 'ido'=>1.5, 'vezetes'=>0, 'telepulesid'=>$t->id]);
        }

        // Alap admin
        User::factory()->create([
            'name'=>'Admin',
            'email'=>'admin@local',
            'password'=>Hash::make('Admin123!'),
            'role'=>'admin',
        ]);
    }
}
