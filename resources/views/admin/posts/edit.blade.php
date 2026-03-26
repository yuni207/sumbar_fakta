@extends('admin.layouts.app', [
'activePage' => 'posts',
])

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4 class="text-sumbar italic font-black uppercase">Edit Post</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/home">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/posts">Posts</a></li>
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
                    <i class="icon-copy dw dw-edit-file mr-2"></i> Perbarui Post
                </h2>
            </div>
            <div class="pull-right">
                <a href="/admin/posts" class="btn btn-outline-secondary btn-sm shadow-sm">
                    <i class="fa fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </div>

        <hr class="mb-30">

        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="weight-600">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $post->title) }}" required class="form-control border-radius-7" placeholder="Masukkan judul post...">
                    </div>

                    <div class="form-group">
                        <label class="weight-600">Author</label>
                        <input type="text" name="author" value="{{ old('author', $post->author) }}" class="form-control border-radius-7" placeholder="Nama Penulis">
                    </div>

                    <div class="form-group">
                        <label class="weight-600">Isi Konten <span class="text-danger">*</span></label>
                        <textarea name="content" id="editor" class="form-control border-radius-7" style="height: 400px;" placeholder="Tuliskan berita lengkap di sini...">{{ old('content', $post->content) }}</textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="weight-600">
                            Kategori <span class="text-danger">*</span>
                        </label>
                        <select name="category" required class="form-control border-radius-7">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="TV" {{ old('category', $post->category) == 'TV' ? 'selected' : '' }}>TV</option>
                            <option value="Politik" {{ old('category', $post->category) == 'Politik'      ? 'selected' : '' }}>Politik</option>
                            <option value="Ekonomi" {{ old('category', $post->category) == 'Ekonomi'      ? 'selected' : '' }}>Ekonomi</option>
                            <option value="Pendidikan" {{ old('category', $post->category) == 'Pendidikan'   ? 'selected' : '' }}>Pendidikan</option>
                            <option value="Hukum" {{ old('category', $post->category) == 'Hukum'        ? 'selected' : '' }}>Hukum & Kriminal</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="weight-600">Tipe Post <span class="text-danger">*</span></label>
                        <select name="type" required class="form-control border-radius-7">
                            <option value="artikel" {{ old('type', $post->type) == 'artikel'  ? 'selected' : '' }}>Artikel</option>
                            <option value="video" {{ old('type', $post->type) == 'video'    ? 'selected' : '' }}>Video (Sumbar TV)</option>
                            <option value="breaking" {{ old('type', $post->type) == 'breaking' ? 'selected' : '' }}>Breaking News</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="weight-600">Tanggal Rilis</label>
                        <input type="datetime-local" name="release_date" value="{{ old('release_date', \Carbon\Carbon::parse($post->release_date)->format('Y-m-d\TH:i')) }}" class="form-control border-radius-7">
                    </div>

                    <div class="form-group">
                        <label class="weight-600">Gambar Unggulan (Upload)</label>
                        @if($post->image_url)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $post->image_url) }}" alt="Gambar saat ini" class="img-thumbnail" style="max-height: 120px;">
                            <small class="d-block text-muted mt-1">Gambar saat ini. Upload baru untuk mengganti.</small>
                        </div>
                        @endif
                        <input type="file" name="image_url" class="form-control-file form-control height-auto border-radius-7">
                        <small class="form-text text-muted">Format: JPG, PNG, JPEG, GIF. Maks: 2MB.</small>
                    </div>

                    <div class="form-group">
                        <label class="weight-600">Video Upload (Opsional)</label>
                        @if($post->video_url && !Str::startsWith($post->video_url, 'http'))
                        <div class="mb-2">
                            <small class="text-muted">File video saat ini: <strong>{{ basename($post->video_url) }}</strong>. Upload baru untuk mengganti.</small>
                        </div>
                        @endif
                        <input type="file" name="video_file" class="form-control-file form-control height-auto border-radius-7">
                        <small class="form-text text-muted">MP4/MOV/OGG. Maks: 20MB.</small>
                    </div>

                    <div class="form-group">
                        <label class="weight-600">Link Video (Opsional)</label>
                        <input type="url" name="video_link" value="{{ old('video_link', Str::startsWith($post->video_url ?? '', 'http') ? $post->video_url : '') }}" class="form-control border-radius-7" placeholder="https://youtube.com/watch?v=...">
                        <small class="form-text text-muted">Gunakan jika tidak meng-upload.</small>
                    </div>
                </div>
            </div>

            <div class="form-group mt-20">
                <button type="submit" class="btn btn-danger bg-sumbar border-0 px-4 shadow-sm">
                    <span class="icon-copy ti-reload mr-2"></span> Update Post
                </button>
                <a href="/admin/posts" class="btn btn-light ml-2">Batal</a>
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
