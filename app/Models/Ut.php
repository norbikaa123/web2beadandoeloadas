<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Ut extends Model {
    protected $table = 'ut';
    public $timestamps = false;
    protected $fillable = ['nev','hossz','allomas','ido','vezetes','telepulesid'];
    public function telepules(){ return $this->belongsTo(Telepules::class, 'telepulesid'); }
}
