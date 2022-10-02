<div class="bg-white rounded-3 p-4 mb-1">
    <div class="row justify-content-between align-items-center">
        <div class="col-auto d-lg-none">
            <a data-bs-toggle="offcanvas" data-bs-target="#offcanvasResponsive" aria-controls="offcanvasResponsive"
                role="button" class="link-dark">
                <i class='bx bx-menu bx-sm d-flex'></i>
            </a>
        </div>
        <div class="col-auto">
            <a href="index.php">
                <img src="{{ Vite::asset('resources/img/website/logo.svg') }}" height="42" class="logo" />
            </a>
        </div>
        <div class="col-auto d-none d-lg-block">
            <a href="#" class="link-dark d-none d-lg-flex fw-bold">
                <i class='bx bxl-whatsapp bx-sm me-1 text-success'></i> Atendimento
            </a>
        </div>
        <div class="col-auto d-lg-none">
            <a href="#" class="link-dark">
                <i class='bx bx-user-circle bx-sm d-flex'></i>
            </a>
        </div>
    </div>
</div>

<div class="offcanvas-lg offcanvas-start offcanvas-menu border-0" tabindex="-1" id="offcanvasResponsive" aria-labelledby="offcanvasResponsiveLabel">
    <div class="offcanvas-header bg-light align-items-center">
        <img src="{{ Vite::asset('resources/img/website/logo.svg') }}" height="24" />
        <a href="#" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasResponsive" aria-label="Close"
            class="link-secondary">
            <i class='bx bx-x bx-sm d-flex'></i>
        </a>
    </div>
    <div class="offcanvas-body">
        <div class="w-100 bg-white bg-opacity-15 blur rounded-3 py-lg-3 px-lg-4 d-lg-flex justify-content-between align-items-center position-relative">
            <div class="row gx-lg-4 gy-2 mb-2 mb-lg-0">

                <div class="col-lg-auto d-lg-none">
                    <a href="#" class="link-light rounded-3">Login</a>
                </div>
                <div class="col-lg-auto d-lg-none">
                    <a href="#" class="link-light rounded-3">Cadastre-se</a>
                </div>

                <div class="col-lg-auto">
                    <a href="#" class="link-light rounded-3">Sobre</a>
                </div>
                <div class="col-lg-auto">
                    <a href="#" class="link-light rounded-3">Anunciantes</a>
                </div>
                <div class="col-lg-auto">
                    <a href="#" class="link-light rounded-3">Peças Obsoletas</a>
                </div>
                <div class="col-lg-auto">
                    <a href="#" class="link-light rounded-3">Anuncie seu estoque</a>
                </div>
                <div class="col-lg-auto">
                    <a href="#" class="link-light rounded-3">Contato</a>
                </div>
            </div>

            <a href="#" class="d-none d-lg-flex align-items-center link-light">
                <i class='bx bx-xs bxs-user p-1 me-2 bg-primary rounded-circle text-white'></i>
                Acessar
            </a>
        </div>
    </div>
</div>
