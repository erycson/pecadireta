<?php

namespace App\Http\Controllers\Painel;

use App\DataTables\Painel\Usuarios;
use App\Http\Controllers\Painel\Controller;
use App\Http\Requests\Painel\Usuario\UsuarioStoreRequest;
use App\Http\Requests\Painel\Usuario\UsuarioUpdateRequest;
use App\Models\Fornecedor;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index(Usuarios $dataTable)
    {
        return $dataTable->render('painel.usuarios.index');
    }

    public function create()
    {
        return view('painel.usuarios.create');
    }

    public function store(UsuarioStoreRequest $request)
    {
        $form = $request->only(['email', 'nome', 'senha', 'fornecedor_id']);
        $form['senha'] = Hash::make($form['senha']);
        $usuario = Usuario::create($form);

        activity()
            ->event('painel.usuario')
            ->by($request->user())
            ->on($usuario)
            ->log('Criou o usuário');

        return redirect()->route('painel.usuarios.edit', [$usuario]);
    }

    public function edit(Usuario $usuario)
    {
        $usuario->loadMissing('fornecedor');
        return view('painel.usuarios.edit', compact('usuario'));
    }

    public function update(Usuario $usuario, UsuarioUpdateRequest $request)
    {
        $form = $request->only(['email', 'nome', 'fornecedor_id']);
        if ($request->filled('senha')) {
            $form['senha'] = Hash::make($request->senha);
        }
        $usuario->update($form);

        activity()
            ->event('painel.usuario')
            ->by($request->user())
            ->on($usuario)
            ->tap(auditor($usuario))
            ->log('Atualizou o usuário');

        return back()->withInput();
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();

        activity()
            ->event('painel.usuario')
            ->by(request()->user())
            ->on($usuario)
            ->tap(auditor($usuario))
            ->log('Desabilitou o usuário');

        return redirect()->route('painel.usuarios.index');
    }

    public function fornecedores()
    {
        return Fornecedor::handleAsyncSelectRequest();
    }
}
