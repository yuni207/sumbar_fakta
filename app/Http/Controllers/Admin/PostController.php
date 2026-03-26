<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category'     => 'required|in:Berita Utama,Politik,Ekonomi,Pendidikan,Hukum',
            'title'        => 'required|max:255',
            'content'      => 'required',
            'author'       => 'required|string|max:100',
            'release_date' => 'required|date',
            'image_url'    => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_file'   => 'nullable|mimes:mp4,mov,ogg|max:20000',
            'video_link'   => 'nullable|url',
            'type'         => 'required|in:artikel,video,breaking',
        ]);

        $data = [
            'category'     => $request->category,  // sudah kapital dari form
            'title'        => $request->title,
            'slug'         => Str::slug($request->title),
            'content'      => $request->content,
            'author'       => $request->author,
            'release_date' => $request->release_date,
            'type'         => $request->type,
            'views'        => 0,
        ];

        if ($request->hasFile('image_url')) {
            $data['image_url'] = $request->file('image_url')->store('posts', 'public');
        }

        if ($request->hasFile('video_file')) {
            $data['video_url'] = $request->file('video_file')->store('videos', 'public');
        } elseif ($request->video_link) {
            $data['video_url'] = $request->video_link;
        }

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Konten berhasil diterbitkan!');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'category'     => 'required',
            'title'        => 'required|max:255',
            'content'      => 'required',
            'author'       => 'required|string|max:100',
            'release_date' => 'required|date',
            'image_url'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_file'   => 'nullable|mimes:mp4,mov,ogg|max:20000',
            'video_link'   => 'nullable|url',
            'type'         => 'required|in:artikel,video,breaking',
        ]);

        $data = [
            'category'     => $request->category,
            'title'        => $request->title,
            'slug'         => Str::slug($request->title),
            'content'      => $request->content,
            'author'       => $request->author,
            'release_date' => $request->release_date,
            'type'         => $request->type,
        ];

        // Update Image
        if ($request->hasFile('image_url')) {

            if ($post->image_url) {
                Storage::disk('public')->delete($post->image_url);
            }

            $data['image_url'] = $request->file('image_url')
                ->store('posts', 'public');
        }

        // Update Video
        if ($request->hasFile('video_file')) {

            if ($post->video_url && !Str::startsWith($post->video_url, 'http')) {
                Storage::disk('public')->delete($post->video_url);
            }

            $data['video_url'] = $request->file('video_file')
                ->store('videos', 'public');
        } elseif ($request->video_link) {

            if ($post->video_url && !Str::startsWith($post->video_url, 'http')) {
                Storage::disk('public')->delete($post->video_url);
            }

            $data['video_url'] = $request->video_link;
        }

        $post->update($data);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Konten berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->image_url) {
            Storage::disk('public')->delete($post->image_url);
        }

        if ($post->video_url && !Str::startsWith($post->video_url, 'http')) {
            Storage::disk('public')->delete($post->video_url);
        }

        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Konten berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        // Mencari berdasarkan judul atau konten
        $results = Post::where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->latest()
            ->paginate(12);

        $setting = \App\Models\Setting::first();

        // Mengambil berita terbaru untuk running text
        $running_news = Post::latest()->limit(5)->get();
        $posts = Post::latest()->get();

        return view('frontend.search-results', compact('results', 'query', 'setting', 'running_news', 'posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        // View counter — hanya hitung sekali per session per artikel
        $sessionKey = 'post_viewed_' . $post->id;
        if (!session()->has($sessionKey)) {
            $post->increment('views');
            session()->put($sessionKey, true);
        }

        // Variabel tambahan untuk layout (header, running text, sidebar)
        $setting      = \App\Models\Setting::first();
        $running_news = Post::latest()->limit(5)->get();
        $posts        = Post::latest()->get(); // dipakai sidebar Terpopuler

        return view('news.show', compact('post', 'setting', 'running_news', 'posts'));
    }
}
