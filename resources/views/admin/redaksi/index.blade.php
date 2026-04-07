@extends('admin.layouts.app', [
'activePage' => 'redaksi',
])

@section('content')
<div class="min-height-200px">

    <!-- HEADER -->
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4 class="text-sumbar italic font-black uppercase">
                        Manajemen Redaksi
                    </h4>
                </div>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.home') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Redaksi
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <!-- CARD -->
    <div class="pd-20 card-box mb-30" style="border-top:5px solid #b70000;">

        <div class="clearfix mb-20">

            <div class="pull-left">
                <h2 class="text-sumbar h4 italic uppercase">
                    <i class="icon-copy dw dw-user mr-2"></i>
                    Daftar Anggota Redaksi
                </h2>
            </div>

            <div class="pull-right">
                <a href="{{ route('admin.redaksi.add') }}" class="btn btn-danger bg-sumbar btn-sm shadow-sm border-0">
                    <i class="fa fa-plus-circle mr-1"></i>
                    Tambah Redaksi
                </a>
            </div>

        </div>

        <hr class="mb-30">


        <!-- SUCCESS -->
        @if (session('success'))
        <div class="alert alert-success border-radius-7 alert-dismissible fade show" role="alert">
            <i class="icon-copy bi bi-check-circle-fill mr-2"></i> {{ session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif


        <!-- TABLE -->
        <div class="pb-20 table-responsive">

            <table class="table table-striped hover w-full">

                <thead>
                    <tr class="bg-sumbar text-white text-uppercase">
                        <th class="text-center">No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Email</th>
                        <th class="text-center">Urutan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($redaksis as $item)
                    <tr>

                        <td class="text-center">
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            <strong>{{ $item->nama }}</strong>
                        </td>

                        <td>
                            <span class="badge badge-outline-danger">
                                {{ $item->jabatan }}
                            </span>
                        </td>

                        <td>
                            {{ $item->email }}
                        </td>

                        <td class="text-center">
                            <span class="badge badge-success">
                                {{ $item->urutan }}
                            </span>
                        </td>

                        <!-- AKSI -->
                        <td class="text-center">

                            <div class="btn-group">

                                <a href="{{ route('admin.redaksi.edit',$item->id) }}" class="btn btn-sm btn-outline-success mr-2 border-radius-7">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <button class="btn btn-sm btn-outline-danger border-radius-7" data-toggle="modal" data-target="#delete-modal-{{ $item->id }}">
                                    <i class="fa fa-trash"></i>
                                </button>

                            </div>

                        </td>

                    </tr>


                    <!-- MODAL DELETE -->
                    <div class="modal fade" id="delete-modal-{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content border-0 shadow-lg">
                                <div class="modal-header bg-sumbar text-white">
                                    <h5 class="modal-title italic uppercase text-white"><i class="fa fa-warning mr-2"></i> Konfirmasi</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                                </div>
                                <div class="modal-body text-center pd-30">
                                    <i class="icon-copy bi bi-trash3 text-danger mb-20 d-block" style="font-size: 50px;"></i>
                                    <h4 class="mb-10 text-dark">Hapus Post?</h4>
                                    <p class="mb-0">Yakin ingin menghapus berita:</p>
                                    <p><strong>"{{ $item->title }}"</strong></p>
                                </div>
                                <div class="modal-footer justify-content-center border-0 pb-30">
                                    <button type="button" class="btn btn-secondary px-4 border-radius-7" data-dismiss="modal">Batal</button>
                                    <a href="{{ route('admin.posts.delete', $item->id) }}" class="btn btn-danger bg-sumbar px-4 border-radius-7 border-0 shadow-sm">Ya, Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @empty
                    @endforelse

                </tbody>
            </table>

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

    .border-radius-7 {
        border-radius: 7px !important;
    }

    .table thead th {
        border: none;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
        vertical-align: middle;
        padding: 12px;
        white-space: nowrap;
    }

    .table tbody td {
        vertical-align: middle;
        padding: 10px;
        word-break: break-word;
    }

    .badge-outline-danger {
        background: transparent;
        border: 1px solid #b70000;
        color: #b70000;
        padding: 4px 8px;
    }

    .btn-group .btn {
        padding: 5px 10px;
    }

</style>

@endsection
