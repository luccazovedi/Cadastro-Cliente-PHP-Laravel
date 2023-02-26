<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index()
    {
        Log::info('Endpoint /api/clientes foi chamado.');

        try {
            $clientes = Cliente::all();
            return response()->json($clientes);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Ocorreu um erro ao listar os clientes.'], 500);
        }
    }

    public function store(Request $request)
    {
        Log::info('Endpoint /api/clientes (POST) foi chamado.');

        $validatedData = $request->validate([
            'nome' => 'required|max:255',
            'cpf' => 'required|max:11|unique:clientes',
            'data_nascimento' => 'required|date',
            'sexo' => 'required',
            'endereco' => 'required|max:255',
            'estado' => 'required|max:2',
            'cidade' => 'required|max:255',
        ]);

        try {
            $cliente = Cliente::create($validatedData);
            return response()->json(['success' => 'Cliente cadastrado com sucesso.'], 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Ocorreu um erro ao cadastrar o cliente.'], 500);
        }
    }
}
