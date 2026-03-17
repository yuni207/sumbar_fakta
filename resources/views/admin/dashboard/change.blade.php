@extends('admin.layouts.app', [
'activePage' => 'bidang',
])

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4 class="text-sumbar italic font-black uppercase">Pengaturan Akun</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/home">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ganti Password</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30" style="border-top: 5px solid #b70000;">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h2 class="text-sumbar h3 italic uppercase">
                    <i class="icon-copy dw dw-shield-check mr-2"></i> Keamanan Akun
                </h2>
                <p class="text-secondary">Perbarui kata sandi Anda secara berkala untuk menjaga keamanan akun redaksi.</p>
            </div>
        </div>

        <hr class="mb-30">

        @if (session('error'))
        <div class="alert alert-danger border-radius-7">
            <i class="icon-copy bi bi-exclamation-triangle-fill mr-2"></i> {{ session('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success border-radius-7">
            <i class="icon-copy bi bi-check-circle-fill mr-2"></i> {{ session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <form action="/admin/change_password" method="POST">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="weight-600">Password Lama</label>
                        <input type="password" autofocus name="current-password" class="form-control" placeholder="••••••••" required>
                        <small class="form-text text-muted">Masukkan password yang Anda gunakan saat ini.</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="weight-600">Password Baru</label>
                        <input type="password" name="new-password" class="form-control" placeholder="••••••••" required>
                        <small class="form-text text-muted">Gunakan minimal 8 karakter dengan kombinasi angka.</small>
                    </div>
                </div>
            </div>

            <div class="form-group mt-10">
                <button type="submit" class="btn btn-danger bg-sumbar border-0 px-4 shadow-sm">
                    <span class="icon-copy ti-save-alt mr-2"></span> Perbarui Password
                </button>
                <a href="/admin/home" class="btn btn-outline-secondary ml-2">Batal</a>
            </div>
        </form>
    </div>
</div>

<style>
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

</style>
@endsection
