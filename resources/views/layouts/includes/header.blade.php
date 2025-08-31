<header class="p-3 bg-dark text-white border-bottom border-dark">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3 text-center text-md-start mb-2 mb-md-0">
                <h3 class="mb-0 fs-4 fw-bold" style="letter-spacing: 1px;">{{ $title ?? '6 SIFAT' }}</h3>
            </div>
            <div class="col-md-9">
                <nav class="d-flex justify-content-center justify-content-md-end gap-3">
                    <a href="{{ url('/10') }}" class="text-decoration-none text-white hover-effect">Home</a>
                    <a href="#" class="text-decoration-none text-white hover-effect">About</a>
                    <a href="{{ url('/contact') }}" class="text-decoration-none text-white hover-effect">Contact</a>
                </nav>
            </div>
        </div>
    </div>
</header>

<style>
    .hover-effect {
        position: relative;
        padding-bottom: 2px;
        transition: color 0.3s, border-bottom 0.3s;
    }

    .hover-effect::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 1px;
        background: #fff;
        transition: width 0.3s;
    }

    .hover-effect:hover {
        color: #fff !important;
    }

    .hover-effect:hover::after {
        width: 100%;
    }
</style>