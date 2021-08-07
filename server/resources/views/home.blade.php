@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
             {{-- if user try to access route developer --}}
             @if (session('wrong-role'))
             <div class="alert alert-danger" role="alert">
                 {{ session('wrong-role') }}
             </div>
             @endif
             
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}
                    You are logged in! <br>
                    @if (auth()->user()->name === 'admin')
                        <a href="/developers">Mode Developer</a>
                    @endif
                    <br>
                    <a href="http://akademik.bias-education.com/" target="_blank">Akademik</a>
                    <a href="http://kepegawaian.bias-education.com/" target="_blank">Kepegawaian</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
