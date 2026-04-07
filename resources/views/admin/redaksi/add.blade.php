@extends('admin.layouts.app', [
'activePage' => 'redaksi',
])

@section('content')
<div class="min-height-200px">

    <!-- HEADER -->
    <div class="page-header">
        <div class="row">
            <div class="col-md-12">
                <div class="title">
                    <h4 class="text-sumbar italic font-black uppercase">
                        Tambah Redaksi Baru
                    </h4>
                </div>

                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.redaksi.index') }}">Redaksi</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Tambah Data
                    </li>
                </ol>
            </div>
        </div>
    </div>

    <!-- CARD -->
    <div class="pd-20 card-box mb-30" style="border-top:5px solid #b70000;">

        <div class="clearfix mb-20">
            <div class="pull-left">
                <h2 class="text-sumbar h4 italic uppercase">
                    <i class="icon-copy dw dw-user-1 mr-2"></i>
                    Tambah Anggota Redaksi
                </h2>
            </div>

            <div class="pull-right">
                <a href="{{ route('admin.redaksi.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <hr>

        {{-- ERROR VALIDASI --}}
        @if ($errors->any())
        <div class="alert alert-danger border-radius-7">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- FORM -->
        <form action="{{ route('admin.redaksi.store') }}" method="POST">
            @csrf

            <div class="row">

                <!-- NAMA -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="weight-600">
                            Nama <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="nama" value="{{ old('nama') }}" required class="form-control border-radius-7" placeholder="Nama anggota redaksi">
                    </div>
                </div>

                <!-- JABATAN -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="weight-600">
                            Jabatan <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="jabatan" value="{{ old('jabatan') }}" required class="form-control border-radius-7" placeholder="Contoh: Pemimpin Redaksi">
                    </div>
                </div>

                <!-- EMAIL -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="weight-600">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control border-radius-7" placeholder="email@media.com">
                    </div>
                </div>

                <!-- URUTAN -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="weight-600">Urutan Tampil</label>
                        <input type="number" name="urutan" value="{{ old('urutan',1) }}" class="form-control border-radius-7">
                        <small class="text-muted">
                            Angka kecil tampil lebih atas
                        </small>
                    </div>
                </div>

            </div>

            <!-- BUTTON -->
            <div class="form-group mt-20">
                <button type="submit" class="btn btn-danger bg-sumbar border-0 px-4 shadow-sm">
                    <i class="icon-copy ti-save mr-2"></i>
                    Simpan Redaksi
                </button>

                <button type="reset" class="btn btn-light ml-2">
                    Reset
                </button>
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
