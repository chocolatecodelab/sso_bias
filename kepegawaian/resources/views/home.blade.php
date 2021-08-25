@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (!auth()->user()->token)
                        <a href="/oauth/redirect">Authorize from server</a>
                    @endif
                    @if(auth()->user()->token)
                    <a href="http://akademik.bias-education.com:8080/" target="_blank">Akademik</a>
                    @endif

                    @foreach ($posts as $post)
                        <div class="py-3 border-bottom">
                            <h3>{{ $post['title'] }}</h3>
                            <div>{{ $post['body'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
