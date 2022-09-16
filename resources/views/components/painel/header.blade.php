<header class="header-main w-100 border-bottom sticky-top d-flex align-items-center">
    <div class="container-fluid position-relative">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto d-flex d-lg-none">
                <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                    <i class='bx bx-menu-alt-left bx-sm' ></i>
                </a>
            </div>
            <div class="col-auto d-none d-lg-flex">
                <div class="dropdown">
                    <a class="btn btn-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Organização
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-auto d-flex d-lg-none position-absolute top-50 start-50 translate-middle">
                <a href="#">
                    <img src="{{ Vite::asset('resources/img/painel/logo-icone.svg') }}" height="24" />
                </a>
            </div>
            <div class="col-auto">
                <div class="row gx-2 align-items-center nav-header">
                    <div class="col-auto d-none d-lg-flex">
                        <div class="search position-relative">
                            <i class='bx bx-search position-absolute top-50 start-0 translate-middle-y ms-3' ></i>
                            <input type="text" class="form-control rounded-pill" placeholder="Pesquisar" aria-label="Pesquisar">
                        </div>
                    </div>
                    <div class="col-auto"><a href="#" class="btn btn-light"><i class='bx bx-bell'></i></a></div>
                    <div class="col-auto">
                        <div class="dropdown">
                            <a href="#" class="avatar bg-primary" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-user"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="py-2 px-3">
                                    <strong class="d-block">Érycson Nóbrega</strong>
                                    <small>felipebuenopereira@gmail.com</small>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li class="py-2 px-3">
                                    <a href="#" class="btn btn-sm btn-danger w-100 rounded-pill">Sair</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
