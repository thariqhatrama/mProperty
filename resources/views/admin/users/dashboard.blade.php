@extends('admin.layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Welcome to the Admin Dashboard</h1>
        <p>This is your admin dashboard, where you can manage the application.</p>

        <div class="row">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header">
                        News Management
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Manage News Articles</h5>
                        <p class="card-text">Create, edit, or delete news articles.</p>
                        <a href="{{ route('news.index') }}" class="btn btn-primary">Manage News</a>
                    </div>
                </div>
            </div>
            <!-- Add more cards for other management links as needed -->
        </div>
    </div>
@endsection