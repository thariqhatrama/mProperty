<?php
namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_date' => 'required|date',
            'author_name' => 'required|string|max:255',
            'image_path' => 'nullable|image|max:2048', // 2MB Max
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('news_images', 'public');
        }

        News::create($data);

        return redirect()->route('news.index')->with('success', 'News has been added successfully.');
    }

    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_date' => 'required|date',
            'author_name' => 'required|string|max:255',
            'image_path' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image_path')) {
            // Delete old image
            if ($news->image_path) {
                Storage::delete('public/' . $news->image_path);
            }

            $data['image_path'] = $request->file('image_path')->store('news_images', 'public');
        }

        $news->update($data);

        return redirect()->route('news.index')->with('success', 'News has been updated successfully.');
    }

    public function destroy(News $news)
    {
        if ($news->image_path) {
            Storage::delete('public/' . $news->image_path);
        }

        $news->delete();

        return redirect()->route('news.index')->with('success', 'News has been deleted successfully.');
    }
}
