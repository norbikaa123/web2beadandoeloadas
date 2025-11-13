<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Np extends Model {
    protected $table = 'np';
    public $timestamps = false;
    protected $fillable = ['nev'];
    public function telepulesek(){ return $this->hasMany(Telepules::class, 'npid'); }
}
