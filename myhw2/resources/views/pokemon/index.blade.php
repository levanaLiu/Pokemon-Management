@extends('layouts.app')

@section('dropdown')
    @if($currentUser->profile and $currentUser->profile->isAdmin)
        <li><a href="/myhw2/public/admin">Admin</a></li>
    @endif
    <li><a href="/myhw2/public/profile/{{$currentUser->id}}">My Profile</a> </li>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    @if (session()->has('flash_notification.message'))
                        <div class="alert alert-{{session('flash_notification.level')}}">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {!! session('flash_notification.message') !!}
                        </div>
                    @endif
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissable" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{$error}}
                            </div>
                        @endforeach
                    @endif
                    <div class="panel-body">
                        <table class="table">
                            <caption ><h4>Total number of pokemon: {{$totalNum}}</h4></caption>
                            <thead>
                                <th>Name</th>
                                <th>Number</th>
                            </thead>
                            <tbody>
                                @foreach($pokemon as $poke)
                                <tr>
                                    <th>{{$poke->name}}</th>
                                    <th>{{$poke->users->count()}}</th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! Form::open() !!}
                        <div class="form-group">
                            {!! Form::label('addPokemon','Please input the Pokemon name: ') !!}
                            {!! Form::text('addPokemon',null,['class'=> 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('deletePokemon','The pokemons that currently exist (select those you want to delete)') !!}
                            {!! Form::select('deletePokemon[]',$currentPokemonName,null,['class' => 'form-control','multiple'=>true]) !!}

                        </div>

                        <div class="form-group">
                            @if(($currentUser->profile) and ($currentUser->profile->isAdmin))
                                {!! Form::submit('Edit',['class' => 'btn btn-primary form-control']) !!}
                            @endif
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection