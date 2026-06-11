<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    /**
     * Exibe a listagem do estoque (e carrega a tela do Dashboard).
     */
    public function index(Request $request)
    {
        $query = Estoque::query();
        
        if ($request->filled('titulo')) {
            $query->where('titulo', 'like', '%' . $request->titulo . '%');
        }

        $estoques = $query->paginate(10);
        
        return view('dashboard.index', compact('estoques'));
    }

    /**
     * Salva um novo item no banco de dados.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo'             => ['required', 'string', 'max:255'],
            'autor'              => ['required', 'string', 'max:255'],
            'status'             => ['required', 'in:Disponivel,Emprestado,Reservado'],
            'genero'             => ['required', 'string', 'max:255'],
            'quantidade_paginas' => ['required', 'integer', 'min:0'],
            'ano_publicacao'     => ['required', 'string', 'max:8'],
        ]);
        
        Estoque::create($validated);
        
        return redirect()->route('dashboard.index')->with('success', 'Item criado com sucesso');
    }

    /**
     * Atualiza um item existente no banco de dados.
     */
    public function update(Request $request, Estoque $estoque)
    {
        $validated = $request->validate([
            'titulo'             => ['required', 'string', 'max:255'],
            'autor'              => ['required', 'string', 'max:255'],
            'status'             => ['required', 'in:Disponivel,Emprestado,Reservado'],
            'genero'             => ['required', 'string', 'max:255'],
            'quantidade_paginas' => ['required', 'integer', 'min:0'],
            'ano_publicacao'     => ['required', 'string', 'max:8'],
        ]);
        
        $estoque->update($validated);
        
        return redirect()->route('dashboard.index')->with('success', 'Item modificado com sucesso');
    }

    /**
     * Deleta um item do banco de dados.
     */
    public function destroy(Estoque $estoque)
    {
        $estoque->delete();
        
        return redirect()->route('dashboard.index')->with('success', 'Item deletado com sucesso');
    }
}