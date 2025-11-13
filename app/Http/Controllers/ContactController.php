<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Message;

class ContactController extends Controller {
    public function create(){ return view('contact.create'); }
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email'=> 'required|email',
            'message'=>'required|string|min:10'
        ]);
        $data['created_at'] = now();
        Message::create($data);
        return back()->with('ok','Üzenet elküldve!');
    }
}
