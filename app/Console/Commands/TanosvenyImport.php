<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TanosvenyImport extends Command {
    protected $signature = 'tanosveny:import {sqlite_path}';
    protected $description = 'Import tanosveny.db (SQLite) into current database';

    public function handle(){
        $path = $this->argument('sqlite_path');
        if (!file_exists($path)) { $this->error('File not found: '.$path); return Command::FAILURE; }

        $pdo = new \PDO('sqlite:'.$path);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $this->info('Importing np ...');
        $stmt = $pdo->query('SELECT id, nev FROM np');
        foreach ($stmt as $row) {
            DB::table('np')->updateOrInsert(['id'=>$row['id']], ['nev'=>$row['nev']]);
        }

        $this->info('Importing telepules ...');
        $stmt = $pdo->query('SELECT id, nev, npid FROM telepules');
        foreach ($stmt as $row) {
            DB::table('telepules')->updateOrInsert(['id'=>$row['id']], ['nev'=>$row['nev'], 'npid'=>$row['npid']]);
        }

        $this->info('Importing ut ...');
        $stmt = $pdo->query('SELECT id, nev, hossz, allomas, ido, vezetes, telepulesid FROM ut');
        foreach ($stmt as $row) {
            DB::table('ut')->updateOrInsert(['id'=>$row['id']], [
                'nev'=>$row['nev'],
                'hossz'=>$row['hossz'],
                'allomas'=>$row['allomas'],
                'ido'=>$row['ido'],
                'vezetes'=>$row['vezetes'],
                'telepulesid'=>$row['telepulesid'],
            ]);
        }

        // messages (opcionális – ha létezik)
        try {
            $this->info('Importing messages ...');
            $stmt = $pdo->query('SELECT id, name, email, message, created_at FROM messages');
            foreach ($stmt as $row) {
                DB::table('messages')->updateOrInsert(['id'=>$row['id']], [
                    'name'=>$row['name'],
                    'email'=>$row['email'],
                    'message'=>$row['message'],
                    'created_at'=>$row['created_at'],
                ]);
            }
        } catch (\Throwable $e) { $this->warn('messages tábla nem található – kihagyva'); }

        // users (role default registered; password_hash -> password)
        try {
            $this->info('Importing users ...');
            $stmt = $pdo->query('SELECT id, name, email, password_hash, role, created_at FROM users');
            foreach ($stmt as $row) {
                $password = $row['password_hash'];
                // ha nem bcrypt: hasheljük újra "Import123!"-re
                if (!is_string($password) || !str_starts_with($password, '$2y$')) {
                    $password = Hash::make('Import123!');
                }
                DB::table('users')->updateOrInsert(['id'=>$row['id']], [
                    'name'=>$row['name'],
                    'email'=>$row['email'],
                    'password'=>$password,
                    'role'=>$row['role'] ?: 'registered',
                    'created_at'=>$row['created_at'] ?: now(),
                    'updated_at'=>now(),
                ]);
            }
        } catch (\Throwable $e) { $this->warn('users tábla nem található – kihagyva'); }

        $this->info('Kész!');
        return Command::SUCCESS;
    }
}
