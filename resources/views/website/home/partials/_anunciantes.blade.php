<!-- Advertisers -->
<div class="container py-5 my-3 my-lg-5">
    <h3 class="text-center mb-5">Nossos anunciantes</h3>

    <div class="swiper swiper-advertisers mb-4">
        <div class="swiper-wrapper">

            @foreach ($agrupamentos->chunk(3) as $colunaAgrupamentos)
                <div class="swiper-slide">
                    <div class="row gy-5 flex-column">
                        @foreach ($colunaAgrupamentos as $agrupamento)
                            <div class="col">
                                <div class="square">
                                    <div class="content p-3">
                                        <a href="#" class="stretched-link grayscale-link">
                                            <img src="{{ $agrupamento->getFirstMediaUrl('logo') }}" class="img-fluid" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center py-3">
            <div class="swiper-pagination swiper-pagination-advertisers"></div>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <a href="#" class="btn btn-primary py-2 px-4 rounded-3">Veja todos anunciantes</a>
    </div>
</div>
