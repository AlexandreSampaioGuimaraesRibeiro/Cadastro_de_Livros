<?php

namespace App\Http\Controllers;

use App\Models\estoque;
use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email'=> ['required','string','max:255'],
            'password'=> ['required','string','max:255'],
        ]);
        
        if ($usuario = usuario::where('email', $validated['email'])->first()) {
            if (Hash::check($validated['password'], $usuario->password)) {
                return redirect()->route('dashboard.index');
            }

        }

        return redirect()->route('login.index')->withErrors(['email' => 'Credenciais inválidas.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(estoque $estoque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(estoque $estoque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, estoque $estoque)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(estoque $estoque)
    {
        //
    }
}
