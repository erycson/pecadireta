<?php

namespace App\Http\Controllers\Painel;

use App\DataTables\Painel\Faqs;
use App\Http\Controllers\Painel\Controller;
use App\Http\Requests\Painel\Faq\FaqStoreRequest;
use App\Http\Requests\Painel\Faq\FaqUpdateRequest;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index(Faqs $dataTable)
    {
        return $dataTable->render('painel.faqs.index');
    }

    public function create()
    {
        return view('painel.faqs.create');
    }

    public function store(FaqStoreRequest $request)
    {
        $faq = Faq::create($request->only([
            'tipo',
            'pergunta',
            'resposta',
        ]));

        activity()
            ->event('painel.faq')
            ->by($request->user())
            ->on($faq)
            ->log('Criou o FAQ');

        return redirect()->route('painel.faqs.edit', [$faq]);
    }

    public function edit(Faq $faq)
    {
        return view('painel.faqs.edit', compact('faq'));
    }

    public function update(FaqUpdateRequest $request, Faq $faq)
    {
        $faq->update($request->only([
            'tipo',
            'pergunta',
            'resposta',
        ]));

        activity()
            ->event('painel.faq')
            ->by($request->user())
            ->on($faq)
            ->tap(auditor($faq))
            ->log('Atualizou o FAQ');

        return redirect()->route('painel.faqs.edit', [$faq]);
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        activity()
            ->event('painel.faq')
            ->by(request()->user())
            ->on($faq)
            ->tap(auditor($faq))
            ->log('Removeu o FAQ');

        return redirect()->route('painel.faqs.index');
    }
}
