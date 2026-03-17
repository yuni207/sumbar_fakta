@extends('admin.layouts.app', [
'activePage' => 'setting',
])

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4 class="text-sumbar italic font-black uppercase">Tambah Identitas Website</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/home">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/setting">Identitas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30" style="border-top: 5px solid #b70000;">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h2 class="text-sumbar h4 italic uppercase">
                    <i class="icon-copy dw dw-edit-2 mr-2"></i> Konfigurasi Identitas Baru
                </h2>
            </div>
            <div class="pull-right">
                <a href="/admin/setting" class="btn btn-outline-secondary btn-sm shadow-sm">
                    <i class="fa fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </div>

        <hr class="mb-30">

        <form action="{{ route('admin.setting.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label class="weight-600">Judul Website (Title) <span class="text-danger">*</span></label>
                        <input type="text" autofocus name="title" required class="form-control border-radius-7" placeholder="Misal: Sumbar Fakta - Cerdas, Tajam...">
                    </div>

                    <div class="form-group">
                        <label class="weight-600">Tagline <span class="text-danger">*</span></label>
                        <input type="text" name="tagline" required class="form-control border-radius-7" placeholder="Misal: Cerdas, Tajam, Terpercaya">
                    </div>

                    <div class="form-group">
                        <label class="weight-600">Email Redaksi <span class="text-danger">*</span></label>
                        <input type="email" name="email" required class="form-control border-radius-7" placeholder="redaksi@sumbarfakta.com">
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label class="weight-600">Favicon <span class="text-danger">*</span></label>
                        <input type="file" name="favicon" required class="form-control height-auto border-radius-7" accept="image/*">
                        <small class="form-text text-muted">Format: JPG/PNG. Rekomendasi 32x32 px.</small>
                    </div>

                    <div class="form-group">
                        <label class="weight-600">Logo Website <span class="text-danger">*</span></label>
                        <input type="file" name="logo" required class="form-control height-auto border-radius-7" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label class="weight-600">Banner Iklan</label>
                        <input type="file" name="iklan" class="form-control height-auto border-radius-7" accept="image/*">
                    </div>
                </div>
            </div>

            <div class="form-group mt-20">
                <button type="submit" class="btn btn-danger bg-sumbar border-0 px-4 shadow-sm">
                    <span class="icon-copy ti-save mr-2"></span> Simpan Identitas
                </button>
                <button type="reset" class="btn btn-light ml-2">Reset</button>
            </div>
        </form>
    </div>
</div>

<style>
    /* Custom Styling Sumbar Fakta */
    .text-sumbar {
        color: #b70000 !important;
    }

    .bg-sumbar {
        background-color: #b70000 !important;
    }

    .bg-sumbar:hover {
        background-color: #8a0000 !important;
    }

    .font-black {
        font-weight: 900;
    }

    .border-radius-7 {
        border-radius: 7px;
    }

    .form-control:focus {
        border-color: #b70000;
        box-shadow: none;
    }

    .breadcrumb-item.active {
        color: #b70000;
        font-weight: 600;
    }

    ::placeholder {
        color: #ced4da !important;
        opacity: 1;
    }

    .height-auto {
        height: auto !important;
        padding: 10px;
    }

</style>
@endsection
