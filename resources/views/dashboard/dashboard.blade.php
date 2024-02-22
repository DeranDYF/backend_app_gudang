@extends('template/layout')
@section('content')
<div class="toolbar bg-transparent pt-6 mb-5" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex flex-column align-items-start me-3 mb-5 mb-lg-0">
            <h1 class="d-flex text-dark fw-bolder fs-3 flex-column mb-0">Dashboard
                <span class="text-muted fs-7 fw-bold mt-2">Selamat Datang
                    <span class="text-primary fw-bolder">{{ Auth::user()->name }}</span></span>
            </h1>
        </div>
    </div>
</div>
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="col-xxl-6">
            <div class="card h-md-100" style="background: linear-gradient(112.14deg, #00D2FF 0%, #3A7BD5 100%)">
                <div class="card-body">
                    <div class="row align-items-center h-100">
                        <div class="col-7 ps-xl-13">
                            <div class="text-white mb-6 pt-6">
                                <span class="fs-4 fw-bold me-2 d-block lh-1 pb-2 opacity-75">Selamat Datang</span>
                                <span class="fs-2qx fw-bolder">Aplikasi Gudang Backend</span>
                            </div>
                        </div>
                        <div class="col-5 pt-10">
                            <div class="bgi-no-repeat bgi-size-contain bgi-position-x-end h-225px" style="background-image:url('assets/media/svg/illustrations/easy/5.svg');"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection