{{-- resources/views/admin/news/show.blade.php --}}
@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h1>{{ $news->title }}</h1>
    <p><strong>Published Date:</strong> {{ \Carbon\Carbon::parse($news->published_date)->format('F d, Y') }}</p>
    <p><strong>Author Name:</strong> {{ $news->author_name }}</p>
    
    @if($news->image_path)
        <img src="{{ asset('storage/news_images/' . $news->image_path) }}" alt="News Image" style="max-width: 100%; height: auto;">
    @endif

    <div class="mt-4">
        <p>{{ $news->content }}</p>
    </div>

    <a href="{{ route('news.index') }}" class="btn btn-primary">Back to News List</a>
</div>
@endsection
