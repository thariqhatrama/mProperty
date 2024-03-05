@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Edit Berita</h2>
    <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Judul Berita:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $news->title }}" required>
        </div>
        <div class="form-group">
            <label for="author">Penulis:</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ $news->author }}" required>
        </div>
        <div class="form-group">
            <label for="published_date">Tanggal Publikasi:</label>
            <input type="date" class="form-control" id="published_date" name="published_date" value="{{ $news->published_date }}" required>
        </div>
        <div class="form-group">
            <label for="image">Gambar Berita:</label>
            <input type="file" class="form-control-file" id="image" name="image">
            @if($news->image)
                <img src="{{ asset('storage/' . $news->image) }}" width="100" alt="gambar-berita">
            @endif
        </div>
        <div class="form-group">
            <label for="content">Isi Berita:</label>
            <textarea class="form-control" id="content" name="content" rows="5" required>{{ $news->content }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
