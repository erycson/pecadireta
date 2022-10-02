<x-website.default-layout>
    <!-- Header -->
    <header class="bg-dark py-3 py-lg-4 position-relative">
        <div class="container-xl position-relative" style="z-index: 3;">
            <x-website.header />

            <div class="search pt-5 pb-1 py-lg-5 my-lg-5 text-center">
                <span class="badge bg-primary mb-2 py-2 px-3 bg-opacity-50">BUSCADOR DE AUTOPEÇAS VIA WEB</span>
                <h2 class="text-white mb-4 text-center px-5">Localize a peça que você precisa</h2>
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        {!! Form::open(['url' => route('website.procurar'), 'class' => 'bg-white bg-opacity-15 blur rounded-4 p-3 p-lg-5', 'novalidate', 'method' => 'get']) !!}
                            <div class="input-group">
                                {!! Form::text('q', null, ['class' => 'form-control form-control-lg border-0', 'placeholder' => 'Digite o código ou descrição da peça', 'aria-describedb' => 'Digite o código ou descrição da peça']) !!}
                                {!! Form::submit('Buscar', ['class' => 'btn btn-lg btn-primary px-4']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

        <a href="#content" class="position-absolute top-100 start-50 translate-middle text-bg-primary rounded-circle d-none d-lg-block" style="z-index: 1;">
            <i class='bx bx-sm bx-down-arrow-alt p-2 text-white'></i>
        </a>

        <div class="bg-home w-100 h-100 bg-dark position-absolute top-50 start-50 translate-middle" style="background-image: url({{ Vite::asset('resources/img/website/bg-home.png') }})"></div>
    </header>

    <a id="content"></a>

    @if ($agrupamentos->isNotEmpty())
        @include('website.home.partials._anunciantes')
    @endif

    <!-- Ad -->
    <div class="row gx-0 mb-lg-5 mb-4">
        <div class="col-lg-6">
            <img src="{{ Vite::asset('resources/img/website/ads.jpg') }}" class="w-100 img-fluid rounded-start rounded-pill" />
        </div>
        <div class="col-lg-6 d-flex align-items-center">
            <div class="container p-lg-5 py-4">
                <h4 class="h2 mb-4">Anuncie seu estoque de peças e acessórios automotivos para todo Brasil, por <strong class="text-success">90 dias grátis!</strong></h4>
                <p class="mb-4">O Peça Direta é a forma mais inovadora de integração de estoques de autopeças e acessórios automotivos entre concessionários, distribuidores, lojas de peças multimarcas, oficinas e para o público em geral, para buscar e comprar autopeças e acessórios de forma direta, sem intermediários e sem comissões. Aqui são encontrados mais de 1.000 fornecedores, com os mais variados estoques de autopeças e acessórios de todo Brasil.</p>
                <a href="#" class="btn btn-lg btn-primary py-2 px-4 rounded-3">Quero anunciar meu estoque</a>
            </div>
        </div>
    </div>

    @include('website.home.partials._diferenciais')

    @if ($parceiros->isNotEmpty())
        @include('website.home.partials._parceiros')
    @endif

    <x-website.footer />

    <x-slot:javascripts>
        @vite('resources/js/website/home/index.jsx')
    </x-slot>
</x-website.default-layout>
