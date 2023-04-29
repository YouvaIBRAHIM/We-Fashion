    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link" href="{{ route('product.index') }}">
                        Produits
                    </a>
                    <a class="nav-link" href="{{ route('category.index') }}">
                        Catégories
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Bienvenue, {{ Auth::user()->name }}</div>
            </div>
        </nav>
    </div>
