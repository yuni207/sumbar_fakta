@extends('admin.layouts.app', [
'activePage' => 'setting',
])

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4 class="text-sumbar italic font-black uppercase">Pengaturan Website</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/home">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30" style="border-top: 5px solid #b70000;">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h2 class="text-sumbar h4 italic uppercase"><i class="icon-copy dw dw-settings mr-2"></i> Konfigurasi Identitas</h2>
            </div>
            {{-- Tombol tambah hanya muncul jika data belum ada --}}
            @if(!$setting)
            <div class="pull-right">
                <a href="/admin/setting/add" class="btn btn-danger bg-sumbar btn-sm shadow-sm border-0">
                    <i class="fa fa-plus-circle mr-1"></i> Tambah Pengaturan
                </a>
            </div>
            @endif
        </div>

        <hr class="mb-30">

        @if (session('success'))
        <div class="alert alert-success border-radius-7">
            <i class="icon-copy bi bi-check-circle-fill mr-2"></i> {{ session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="pb-20 table-responsive">
            <table class="table table-striped hover w-full">
                <thead>
                    <tr class="bg-sumbar text-white text-uppercase">
                        <th class="text-center">Favicon</th>
                        <th class="text-center">Logo</th>
                        <th>Title & Tagline</th>
                        <th>Email Redaksi</th>
                        <th class="text-center">Banner</th>
                        <th class="datatable-nosort text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($setting)
                    <tr>
                        <td class="text-center align-middle">
                            <img src="{{ asset('storage/'.$setting->favicon) }}" width="32" class="img-thumbnail border-0 shadow-sm">
                        </td>
                        <td class="text-center align-middle">
                            <img src="{{ asset('storage/'.$setting->logo) }}" width="100" class="img-thumbnail border-0">
                        </td>
                        <td class="align-middle">
                            <div class="font-weight-bold text-dark">{{ Str::limit($setting->title, 50) }}</div>
                            <small class="text-muted italic">{{ Str::limit($setting->tagline, 70) }}</small>
                        </td>
                        <td class="align-middle font-weight-bold text-dark">{{ $setting->email }}</td>
                        <td class="text-center align-middle">
                            <img src="{{ asset('storage/'.$setting->iklan) }}" width="80" class="img-thumbnail shadow-sm border-0">
                        </td>
                        <td class="text-center align-middle">
                            <div class="btn-group">
                                <a href="/admin/setting/edit/{{$setting->id}}" class="btn btn-sm btn-outline-success mr-2" data-toggle="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#delete-modal" title="Hapus">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @else
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Hapus (Hanya perlu satu karena data cuma satu) --}}
@if($setting)
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-sumbar text-white">
                <h5 class="modal-title italic uppercase text-white"><i class="fa fa-warning mr-2"></i> Konfirmasi Hapus</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body text-center pd-30">
                <i class="bi bi-trash3 text-danger mb-20 d-block" style="font-size: 60px;"></i>
                <h4 class="mb-10 text-dark">Hapus Pengaturan?</h4>
                <p>Menghapus konfigurasi ini dapat menyebabkan elemen website (Logo, Title, dll) tidak muncul di halaman utama.</p>
            </div>
            <div class="modal-footer justify-content-center border-0 pb-30">
                <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">Batal</button>
                <a href="/admin/setting/delete/{{$setting->id}}" class="btn btn-danger bg-sumbar px-4 border-0 shadow-sm">Ya, Hapus</a>
            </div>
        </div>
    </div>
</div>
@endif

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

    .table thead th {
        border: none;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
    }

    .img-thumbnail {
        border-radius: 5px;
        background-color: #f8f9fa;
    }

</style>
@endsection
