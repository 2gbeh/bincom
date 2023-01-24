<header class="p-3 mb-3 border-bottom bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="{{ url('/') }}" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                <img class="logo" src="{{ asset('images/logo.png') }}" alt="{{ $ctx->alias }}" style="width:40px;" />
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 mx-2">
                <li>
                    <a href="{{ url('/') }}" class="nav-link px-2" style="color:#fff;">
                        <sup>Q1.</sup>
                        Results by @pu
                    </a>
                </li>
                <li>
                    <a href="{{ url('/search?lga_id=-1') }}" class="nav-link px-2" style="color:#fff;">
                        <sup>Q2.</sup>
                        Results by LGA
                    </a>
                </li>
            </ul>

            <div class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                <a href="{{ url('/create') }}" target="_new" class="btn btn-success" style="background-color:#3fa14b;">
                    <sup>Q3.</sup>
                    Add @pu Result
                </a>
            </div>
        </div>
    </div>
</header>
