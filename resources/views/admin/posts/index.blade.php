@extends('admin.layouts.app', [
'activePage' => 'posts',
])

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4 class="text-sumbar italic font-black uppercase">Manajemen Posts</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Posts</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30" style="border-top: 5px solid #b70000;">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h2 class="text-sumbar h4 italic uppercase"><i class="icon-copy dw dw-newspaper mr-2"></i> Daftar Posts</h2>
            </div>
            <div class="pull-right">
                <a href="{{ route('admin.posts.add') }}" class="btn btn-danger bg-sumbar btn-sm shadow-sm border-0">
                    <i class="fa fa-plus-circle mr-1"></i> Tambah Post
                </a>
            </div>
        </div>

        <hr class="mb-30">

        @if (session('success'))
        <div class="alert alert-success border-radius-7 alert-dismissible fade show" role="alert">
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
                        <th class="text-center">Gambar</th>
                        <th class="text-center">Kategori</th>
                        <th>Judul</th>
                        <th class="text-center">Tipe/Video</th>
                        <th class="datatable-nosort text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $item)
                    <tr>
                        <td class="text-center">
                            @if($item->image_url)
                            <img src="{{ asset('storage/' . $item->image_url) }}" class="border-radius-7 shadow-sm" style="width: 60px; height: 45px; object-fit: cover;" alt="Thumb">
                            @else
                            <div class="bg-light border-radius-7 d-flex align-items-center justify-content-center mx-auto" style="width: 60px; height: 45px; border: 1px dashed #ccc;">
                                <i class="fa fa-image text-muted"></i>
                            </div>
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="badge badge-outline-danger text-sumbar border-danger uppercase" style="font-size: 10px;">{{ $item->category }}</span>
                        </td>
                        <td style="white-space: normal; min-width: 250px; word-break: break-word;">
                            <div class="font-weight-bold text-dark" style="word-break: break-word;">{{ Str::limit($item->title, 70) }}</div>
                            <small class="text-muted">Slug: {{ $item->slug }}</small>
                        </td>
                        <td class="text-center">
                            @if($item->type == 'video' && $item->video_url)
                            @if(Str::startsWith($item->video_url, 'http'))
                            <a href="{{ $item->video_url }}" target="_blank" class="badge badge-info shadow-sm" title="Buka Link YouTube">
                                <i class="fa fa-youtube-play mr-1"></i> Link
                            </a>
                            @else
                            <a href="{{ asset('storage/' . $item->video_url) }}" target="_blank" class="badge badge-primary shadow-sm" title="Putar Video Lokal">
                                <i class="fa fa-play-circle mr-1"></i> File
                            </a>
                            @endif
                            @else
                            <span class="badge badge-{{ $item->type == 'breaking' ? 'danger' : 'secondary' }}">
                                {{ ucfirst($item->type) }}
                            </span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('admin.posts.edit', $item->id) }}" class="btn btn-sm btn-outline-success mr-2 border-radius-7" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button class="btn btn-sm btn-outline-danger border-radius-7" data-toggle="modal" data-target="#delete-modal-{{ $item->id }}" title="Hapus">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- Modal Hapus --}}
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
                    @endforeach
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
