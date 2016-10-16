@extends('layouts.app')
@section('search')
    <li>
        <div class="navbar-form navbar-right">
            {!! Form::open() !!}
                {!! Form::text('name',null) !!}
                {!! Form::submit('Search') !!}
            {!! Form::close() !!}
        </div>
    </li>

@endsection

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
                    <table class="table">
                        <caption class="text-center"><strong><h4>Profiles</h4></strong></caption>
                        <thead>
                            <th>Name</th>
                            <th>Hometown</th>
                            <th>Number</th>
                            <th>Names</th>
                            <th>isAdmin</th>
                            @if($currentUser->profile)
                                @if($currentUser->profile->isAdmin)
                                    <th>Action</th>
                                @endif
                            @endif
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th>{{$user->name}}</th>
                                    <th>
                                        @if($user->profile)
                                            {{$user->profile->hometown}}
                                        @endif
                                    </th>
                                    <th>
                                            {{$user->pokemon->count()}}
                                    </th>
                                    <th>
                                            @foreach($user->pokemon as $poke)
                                                <li>{{$poke->name}}</li>
                                            @endforeach
                                    </th>
                                    <th>
                                        @if($user->profile)
                                            {{$user->profile->isAdmin}}
                                        @endif
                                    </th>
                                    @if($currentUser->profile and $currentUser->profile->isAdmin)
                                        @if($user->profile)
                                            <th><button onclick="window.location.href='profile/{{$user->id}}'">Edit</button></th>
                                        @else
                                            <th>N/A</th>
                                        @endif
                                    @endif

                                </tr>

                            @endforeach
                        </tbody>

                    </table>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
