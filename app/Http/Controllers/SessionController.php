<?php

namespace App\Http\Controllers;

use App\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        $sessions = Session::orderByDesc('id')->get();
        return view('sessions.index', compact('sessions'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        
    }

    public function show(Session $session)
    {
        
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, Session $session)
    {
        $i = count($session->made);

        $made = $session->made;

        $made[$i]['datetime'] = date('Y-m-d h:i:s');
        $made[$i]['user'] = auth()->user()->name;

        $session->made = $made;
        $session->save();

        return redirect('/sessions');
    }

    public function destroy($id)
    {

    }
}
