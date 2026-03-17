@extends('admin.layouts.app', [
'activePage' => 'dashboard',
])

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4 class="text-sumbar italic font-black uppercase">Dashboard Redaksi</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/home">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Statistik Berita</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
            <div class="card-box pd-20 height-100-p mb-30" style="border-left: 6px solid #b70000;">
                <div class="row align-items-center">
                    <div class="col-md-4 text-center">
                        <div class="pd-20">
                            <i class="bi bi-newspaper text-sumbar" style="font-size: 150px; opacity: 0.9;"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h4 class="font-20 weight-500 mb-10 text-capitalize">
                            Selamat Datang Kembali,
                            <div class="weight-800 font-40 text-sumbar italic">
                                {{ auth()->user()->name }}
                            </div>
                        </h4>
                        <p class="font-18 max-width-700 text-justify text-secondary">
                            Panel Administrasi <strong>Sumbar Fakta</strong> adalah pusat kendali konten digital Anda. Di sini Anda dapat mengelola publikasi berita, kategori, serta memantau konten video Sumbar TV. Pastikan setiap informasi yang diterbitkan tetap <strong>Cerdas, Tajam, dan Terpercaya.</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    .text-sumbar {
        color: #b70000 !important;
    }

    .bg-sumbar {
        background-color: #b70000 !important;
    }

    .font-black {
        font-weight: 900;
    }

    .card-box {
        border-radius: 10px;
    }

</style>
@endsection
