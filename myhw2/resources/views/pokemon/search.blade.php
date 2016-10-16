@extends('layouts.app')

@section('dropdown')
    @if($currentUser->profile)
        @if($currentUser->profile->isAdmin)
            <li><a href="/myhw2/public/admin">Admin</a> </li>
        @endif
    @endif
    <li><a href="/myhw2/public/profile/{{$currentUser->id}}">My Profile</a> </li>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div>Name of Pokemon: {{$name}}</div>
                        <div>Number of Trainers who have this Pokemon: {{$number}}</div>
                        <div>Trainers List: </div>
                        <div>
                            <ul>
                                @if($users)
                                    @foreach($users as $user)
                                        <li>{{$user->name}}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection