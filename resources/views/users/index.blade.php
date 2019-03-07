@extends('layouts.global')

@section('title') User lists @endsection

@section('content')
    <form action="{{ route('users.index') }}">
        <div class="row">
            <div class="col-md-6">
                <input value="{{ Request::get('keyword') }}" name="keyword" class="form-control col-md-10" type="text" placeholder="Filter berdasarkan email"/>
            </div>
        
            <div class="col-md-6">
                <input {{Request::get('status') == 'ACTIVE' ? "checked" : ""}} value="ACTIVE" name="status" type="radio" class="form-control" id="active"/><label for="active">Active</label>

                <input {{Request::get('status') == 'INACTIVE' ? "checked" : ""}} value="INACTIVE" name="status" type="radio" class="form-control" id="inactive"/><label for="inactive">In Active</label>
                
                <input type='submit' value='filter' class='btn btn-primary'/>
            </div>
        </div>
    </form>
    <br>
    <div class="row">
        <div class="col-md-12 text-left">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Create user</a>
        </div>
    </div>
    <br>
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><strong>Name</strong></th>
                <th><strong>Username</strong></th>
                <th><strong>Email</strong></th>
                <th><strong>Avatar</strong></th>
                <th><strong>Status</strong></th>
                <th><strong>Action</strong></th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->avatar)
                        <img src="{{ asset('storage/'. $user->avatar) }}" width="70px"/>
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    @if($user->status == "ACTIVE") <span class="badge badge-success"> {{ $user->status }}</span>
                    @else
                        <span class="badge badge-danger"> {{ $user->status }}</span>
                    @endif
                </td>
                <td><a class="btn btn-info text-white btn-sm" href="{{ route('users.edit', ['id' => $user->id]) }}">Edit</a> || <a href="{{ route('users.show', ['id' => $user->id]) }}" class="btn btn-primary btn-sm">Detail</a> || <form onsubmit="return confirm('Delete this user permanently?')" class="d-inline" action="{{ route('users.destroy', ['id' => $user->id]) }}" method="POST">
                    @csrf

                    <input type="hidden" name="_method" value="DELETE"/>

                    <input type="submit" value="Delete" class="btn btn-danger btn-sm"/>
                </form>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="10">
                    {{-- {{ $users->links() }} --}}
                    {{ $users->appends(Request::all())->links()}}
                </td>
            </tr>
        </tfoot>
    </table>
@endsection
