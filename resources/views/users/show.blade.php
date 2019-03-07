@extends('layouts.global')

@section('title') Detail User {{ $user->username }} @endsection

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <b>Name : </b><br/>
                {{ $user->name}}
                <br/><br/>

                @if($user->avatar)
                    <img src='{{ asset("storage/". $user->avatar) }}' width="120px"/>
                @else
                    No Avatar
                @endif

                <br><br>
                <b>Phone Number</b><br>
                {{ $user->phone }}
                
                <br><br>
                <b>Address</b><br>
                {{ $user->address }}

                <br><br>
                <b>Roles : </b><br/>
                @foreach(json_decode($user->roles) as $role)
                    &middot; {{ $role }}
                @endforeach
            </div>
        </div>
    </div>
@endsection