<!-- Dealership -->
<div class="bg-gradient-primary-light position-relative">
    <div class="container-xl py-4 py-lg-5">

        <div class="row gx-lg-5 gy-3">
            <div class="col-lg-2">
                <div class="row align-items-center">
                    @if ($peca->fornecedor->logo)
                        <div class="col-3 col-lg-auto">
                            <div class="square bg-white rounded-4 shadow-sm">
                                <div class="content p-2 p-lg-3">
                                    <a href="#" class="stretched-link grayscale-link">
                                        <img src="{{ $peca->fornecedor->getFirstMediaUrl('logo') }}" class="img-fluid" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col d-lg-none">
                        <h1 class="h5 mb-0 mb-lg-3 pb-3 border-bottom border-dark">{{ $peca->fornecedor->nome_fantasia }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-lg">
                <div class="row gx-lg-5 gy-3">
                    <div class="col-lg-6">
                        <h1 class="h5 mb-3 pb-3 text-dark border-bottom border-dark d-none d-lg-block">{{ $peca->fornecedor->nome_fantasia }}</h1>
                        <div class="row gy-1 gy-lg-2 flex-column">
                            <div class="col d-flex align-items-center">
                                <span class="d-flex align-items-center">
                                    <i class='bx bx-store bx-xs text-bg-dark p-1 me-2 rounded-circle' ></i>
                                    {{ $peca->fornecedor->tipo->nome }}
                                </span>
                            </div>

                            <div class="col">
                                <span class="d-flex align-items-center">
                                    <i class='bx bx-group bx-xs text-bg-dark p-1 me-2 rounded-circle' ></i>
                                    {{ $peca->fornecedor->razao_social }}
                                </span>
                            </div>

                            <div class="col d-flex align-items-center">
                                <a href="{{ $peca->fornecedor->url }}" class="d-inline-flex align-items-center text-black">
                                    <i class='bx bx-link bx-xs text-bg-dark p-1 me-2 rounded-circle' ></i>
                                    {{ $peca->fornecedor->url }}
                                </a>
                            </div>

                            @foreach ($peca->fornecedor->contatos as $contato)
                                <div class="col">
                                    <a href="#" class="d-inline-flex align-items-center text-black">
                                        <i class='bx {{ $contato->iconeCss }} bx-xs text-bg-dark p-1 me-2 rounded-circle' ></i>
                                        {{ $contato->contato }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="row gy-1 flex-column">
                            <div class="d-flex align-items-center">
                                <i class='bx bx-map bx-xs text-bg-dark p-1 me-2 rounded-circle' ></i>
                                <span class="small mb-2">{{ $peca->fornecedor->cep->cepExtenso }}</span>
                            </div>
                            <iframe class="w-100" src="https://www.google.com/maps/embed/v1/place?q={{ $peca->fornecedor->latitude }},{{ $peca->fornecedor->longitude }}&zoom=15&key={{ env('GOOGLE_MAP_KEY') }}" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 g-lg-5 align-items-lg-start d-none">
            <div class="col-2">
                <div class="square bg-white rounded-4 shadow-sm">
                    <div class="content p-2 p-lg-3">
                        <a href="{{ $peca->fornecedor->url }}" class="stretched-link grayscale-link">
                            <img src="{{ $peca->fornecedor->getFirstMediaUrl('logo') }}" class="img-fluid" />
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <h1 class="h4 mb-0">{{ $peca->fornecedor->nome_fantasia }}</h1>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="row gy-1 flex-column">
                            <div class="col">{{ $peca->fornecedor->tipo->nome }}</div>
                            <div class="col">{{ $peca->fornecedor->razao_social }}</div>
                            <div class="col"><a href="{{ $peca->fornecedor->url }}">{{ $peca->fornecedor->url }}</a></div>
                            @foreach ($peca->fornecedor->contatos as $contato)
                                <div class="col">{{ $contato->contato }}</div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <p class="mb-3">{{ $peca->fornecedor->cep->cepExtenso }}</p>
                        <iframe class="w-100" src="https://www.google.com/maps/embed/v1/place?q={{ $peca->fornecedor->latitude }},{{ $peca->fornecedor->longitude }}&zoom=15&key={{ env('GOOGLE_MAP_KEY') }}" height="110" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <i class='bx bx-check-circle bx-md bg-primary text-white rounded-circle p-2 position-absolute top-100 start-50 translate-middle'></i>
</div>
