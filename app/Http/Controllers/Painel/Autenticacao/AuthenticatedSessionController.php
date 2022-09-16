<?php

namespace App\Http\Controllers\Painel\Autenticacao;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Painel\Controller;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Painel\Autenticacao\EntrarRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('painel.autenticacao.entrar');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Painel\Autenticacao\EntrarRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(EntrarRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        activity()
            ->event('painel.usuario')
            ->by($request->user())
            ->log('Entrou no sistema');

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        activity()
            ->event('painel.usuario')
            ->by($request->user())
            ->log('Saiu do sistema');

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('painel.entrar'));
    }
}
