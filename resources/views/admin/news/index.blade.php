{{-- resources/views/admin/news/index.blade.php --}}
@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <h2>News List</h2>
            <a href="{{ route('news.create') }}" class="btn btn-primary">Add News</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Published At</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($news as $newsItem)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $newsItem->title }}</td>
                        <td>{{ $newsItem->published_date }}</td>
                        <td>
                            <a href="{{ route('news.show', $newsItem->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('news.edit', $newsItem->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('news.destroy', $newsItem->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
