@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Developers Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <passport-clients></passport-clients><br>

                    
                        {{-- flash message --}}
                    @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{session('message')}}
                      </div>
                    @endif
                    {{-- flash message end --}}

                    {{-- Menu User Token --}}
                    <div class="card-header">User Token</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <tr>
                                <thead>
                                    <th>User id</th>
                                    <th>Name</th>
                                    <th class="text-center">Revoke</th>
                                </thead>
                            </tr>
                            <tr>
                                @foreach ($tokens as $token) 
                                <tbody >
                                    <td>{{$token->user_id}}</td>
                                    <td>{{$token->name}}</td>
                                    <td class="text-center text-danger">
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{ $token->user_id }}">Delete</button>
                                    </td>
                                </tbody>
                                @endforeach
                            </tr>
                        </table>
                    </div>

                @foreach ($tokens as $token)   
                    <div class="modal modal-danger fade" id="delete{{$token->user_id}}">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Warning</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                              <p>Are you sure want to delete the <b>{{$token->name}}</b> token ?</p> 
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                              <button type="button" class="btn btn-danger">
                                  <a style="text-decoration: none; color: white;" href="/developers/delete/{{$token->user_id}}">Delete</a>
                              </button>
                            </div>
                          </div>
                        </div>
                    </div>
                @endforeach     
                    {{-- Menu User Token end --}}
                    
                    
                   
                    {{-- <passport-authorized-clients></passport-authorized-clients> --}}
                    <passport-personal-access-tokens></passport-personal-access-tokens>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
