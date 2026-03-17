@extends('admin.layouts.app', [
'activePage' => 'posts',
])

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4 class="text-sumbar italic font-black uppercase">Tambah Post Baru</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Posts</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Post</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30" style="border-top: 5px solid #b70000;">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h2 class="text-sumbar h4 italic uppercase">
                    <i class="icon-copy dw dw-newspaper mr-2"></i> Tulis Post Baru
                </h2>
            </div>
            <div class="pull-right">
                <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary btn-sm shadow-sm">
                    <i class="fa fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </div>

        <hr class="mb-30">

        {{-- Menampilkan Error Validasi Jika Ada --}}
        @if ($errors->any())
        <div class="alert alert-danger border-radius-7">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="weight-600">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}" required class="form-control border-radius-7" placeholder="Masukkan judul post...">
                    </div>

                    <div class="form-group">
                        <label class="weight-600">Isi Konten <span class="text-danger">*</span></label>
                        {{-- Tambahkan ID 'editor' untuk integrasi text editor nantinya --}}
                        <textarea name="content" id="editor" class="form-control border-radius-7" style="height: 400px;" placeholder="Tuliskan berita lengkap di sini...">{{ old('content') }}</textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="weight-600">Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="category" value="{{ old('category') }}" required class="form-control border-radius-7" placeholder="Misal: Politik, Ekonomi, Budaya">
                    </div>

                    <div class="form-group">
                        <label class="weight-600">Tipe Post <span class="text-danger">*</span></label>
                        <select name="type" required class="form-control border-radius-7">
                            <option value="artikel" {{ old('type') == 'artikel' ? 'selected' : '' }}>Artikel</option>
                            <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video (Sumbar TV)</option>
                            <option value="breaking" {{ old('type') == 'breaking' ? 'selected' : '' }}>Breaking News</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="weight-600">Gambar Unggulan (Upload) <span class="text-danger">*</span></label>
                        <input type="file" name="image_url" required class="form-control-file form-control height-auto border-radius-7">
                        <small class="form-text text-muted">Format: JPG, PNG, JPEG, GIF. Maks: 2MB.</small>
                    </div>

                    <div class="form-group">
                        <label class="weight-600">Video Upload (Opsional)</label>
                        <input type="file" name="video_file" class="form-control-file form-control height-auto border-radius-7">
                        <small class="form-text text-muted">MP4/MOV/OGG. Maks: 20MB.</small>
                    </div>

                    <div class="form-group">
                        <label class="weight-600">Link Video (Opsional)</label>
                        <input type="url" name="video_link" value="{{ old('video_link') }}" class="form-control border-radius-7" placeholder="https://youtube.com/watch?v=...">
                        <small class="form-text text-muted">Gunakan jika tidak meng-upload.
                        </small>
                    </div>
                </div>
            </div>

            <div class="form-group mt-20">
                <button type="submit" class="btn btn-danger bg-sumbar border-0 px-4 shadow-sm">
                    <i class="icon-copy ti-save mr-2"></i> Terbitkan Sekarang
                </button>
                <button type="reset" class="btn btn-light ml-2">Reset</button>
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

    .height-auto {
        height: auto !important;
        padding: 10px;
    }

</style>
@endsection
