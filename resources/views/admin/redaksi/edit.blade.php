@extends('admin.layouts.app', [
'activePage' => 'redaksi',
])

@section('content')
<div class="min-height-200px">

    <div class="page-header">
        <div class="row">
            <div class="col-md-12">
                <div class="title">
                    <h4 class="text-sumbar italic font-black uppercase">
                        Edit Redaksi
                    </h4>
                </div>

                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/admin/home">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.redaksi.index') }}">Redaksi</a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30" style="border-top:5px solid #b70000;">

        <div class="clearfix mb-20">
            <div class="pull-left">
                <h2 class="text-sumbar h4 italic uppercase">
                    <i class="icon-copy dw dw-edit-file mr-2"></i>
                    Perbarui Data Redaksi
                </h2>
            </div>

            <div class="pull-right">
                <a href="{{ route('admin.redaksi.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <hr>

        <form action="{{ route('admin.redaksi.update',$redaksi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">

                <!-- NAMA -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="weight-600">
                            Nama <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="nama" value="{{ old('nama',$redaksi->nama) }}" class="form-control border-radius-7" required>
                    </div>
                </div>

                <!-- JABATAN -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="weight-600">
                            Jabatan <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="jabatan" value="{{ old('jabatan',$redaksi->jabatan) }}" class="form-control border-radius-7" required>
                    </div>
                </div>

                <!-- EMAIL -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="weight-600">Email</label>
                        <input type="email" name="email" value="{{ old('email',$redaksi->email) }}" class="form-control border-radius-7">
                    </div>
                </div>

                <!-- URUTAN -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="weight-600">Urutan Tampil</label>
                        <input type="number" name="urutan" value="{{ old('urutan',$redaksi->urutan) }}" class="form-control border-radius-7">
                        <small class="text-muted">
                            Semakin kecil angka → tampil paling atas
                        </small>
                    </div>
                </div>

            </div>

            <div class="form-group mt-20">
                <button class="btn btn-danger bg-sumbar border-0 px-4">
                    Update Redaksi
                </button>

                <a href="{{ route('admin.redaksi.index') }}" class="btn btn-light ml-2">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>

<style>
    .text-sumbar {
        color: #b70000 !important;
    }

    .bg-sumbar {
        background: #b70000 !important;
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
