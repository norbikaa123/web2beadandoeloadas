<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Message extends Model {
    protected $table = 'messages';
    public $timestamps = false;
    protected $fillable = ['name','email','message','created_at'];
}
