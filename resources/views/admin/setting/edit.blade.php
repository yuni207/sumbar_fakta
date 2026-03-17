@extends('admin.layouts.app', [
'activePage' => 'setting',
])

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4 class="text-sumbar italic font-black uppercase">Edit Identitas Website</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/home">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/setting">Identitas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30" style="border-top: 5px solid #b70000;">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h2 class="text-sumbar h4 italic uppercase">
                    <i class="icon-copy dw dw-edit-file mr-2"></i> Perbarui Konfigurasi
                </h2>
            </div>
            <div class="pull-right">
                <a href="/admin/setting" class="btn btn-outline-secondary btn-sm shadow-sm">
                    <i class="fa fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </div>

        <hr class="mb-30">

        <form action="{{ route('admin.setting.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label class="weight-600">Judul Website (Title) <span class="text-danger">*</span></label>
                        <input type="text" name="title" value="{{ $setting->title }}" required class="form-control border-radius-7">
                    </div>

                    <div class="form-group">
                        <label class="weight-600">Tagline <span class="text-danger">*</span></label>
                        <input type="text" name="tagline" value="{{ $setting->tagline }}" required class="form-control border-radius-7">
                    </div>

                    <div class="form-group">
                        <label class="weight-600">Email Redaksi <span class="text-danger">*</span></label>
                        <input type="email" name="email" value="{{ $setting->email }}" required class="form-control border-radius-7">
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label class="weight-600">Favicon</label>
                        <div class="mb-2">
                            <img src="{{ asset('storage/'.$setting->favicon) }}" width="30" class="img-thumbnail border-0 shadow-sm">
                        </div>
                        <input type="file" name="favicon" class="form-control height-auto border-radius-7" accept="image/*">
                        <small class="text-muted">Pilih file baru jika ingin mengganti favicon.</small>
                    </div>

                    <div class="form-group">
                        <label class="weight-600">Logo Website</label>
                        <div class="mb-2">
                            <img src="{{ asset('storage/'.$setting->logo) }}" width="120" class="img-thumbnail border-0 shadow-sm">
                        </div>
                        <input type="file" name="logo" class="form-control height-auto border-radius-7" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label class="weight-600">Banner Iklan</label>
                        <div class="mb-2">
                            @if($setting->iklan)
                            <img src="{{ asset('storage/'.$setting->iklan) }}" width="120" class="img-thumbnail border-0 shadow-sm">
                            @else
                            <span class="badge badge-secondary">Belum ada iklan</span>
                            @endif
                        </div>
                        <input type="file" name="iklan" class="form-control height-auto border-radius-7" accept="image/*">
                    </div>
                </div>
            </div>

            <div class="form-group mt-20">
                <button type="submit" class="btn btn-danger bg-sumbar border-0 px-4 shadow-sm">
                    <span class="icon-copy ti-reload mr-2"></span> Update Identitas
                </button>
                <a href="/admin/setting" class="btn btn-light ml-2">Batal</a>
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

    .height-auto {
        height: auto !important;
        padding: 10px;
    }

    .img-thumbnail {
        background-color: #f8f9fa;
    }

</style>
@endsection
