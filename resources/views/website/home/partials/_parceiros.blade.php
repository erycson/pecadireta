<!-- Partners -->
<div class="container-xl py-5 my-3 my-lg-5">
    <h3 class="text-center mb-4">Parceiros</h3>

    <div class="swiper swiper-partners mb-4">
        <div class="swiper-wrapper">
            @foreach ($parceiros as $parceiro)
                <div class="swiper-slide">
                    <div class="square">
                        <div class="content p-3">
                            <a href="#" class="stretched-link grayscale-link">
                                <img src="{{ $parceiro->getFirstMediaUrl('logo') }}" class="img-fluid" />
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center py-3">
            <div class="swiper-pagination swiper-pagination-partners"></div>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <a href="#" class="btn btn-primary py-2 px-4 rounded-3">Veja todos parceiros</a>
    </div>
</div>
