@extends('layouts.app')

@section('dropdown')
    @if($currentUser->profile and $currentUser->profile->isAdmin)
        <li><a href="/myhw2/public/admin">Admin</a> </li>
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
                        <h4><strong>My Profile</strong></h4>
                        {!! Form::open() !!}
                        <div class="form-group">
                            {!! Form::label('name','Name:') !!}
                            {!! Form::text('name',$user->name,['class'=> 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('email','Email:') !!}
                            {!! Form::text('email',$user->email,['class'=> 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('hometown','Hometown:') !!}
                            @if($user->profile)
                                {!! Form::text('hometown',$user->profile->hometown,['class'=> 'form-control']) !!}
                            @else
                                {!! Form::text('hometown',null,['class'=> 'form-control']) !!}
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::label('Number of Pokemon','Number of Pokemons:') !!}
                            {!! Form::label($user->pokemon->count(),null,['class'=> 'form-control-static']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('isAdmin','isAdmin:') !!}
                            @if($user->profile)
                                {!! Form::label($user->profile->isAdmin,null,['class'=> 'form-control-static']) !!}
                            @else
                                {!! Form::label(0,null,['class'=> 'form-control-static']) !!}
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::label('deletePokemon','The pokemons that you currently have (select those you want to delete)') !!}
                            {!! Form::select('deletePokemon[]',$currentPokemonName,null,['class' => 'form-control','multiple'=>true]) !!}

                        </div>

                        <div class="form-group">
                            {!! Form::label('addPokemon','All pokemons (select those you want to add)') !!}
                            {!! Form::select('addPokemon[]',$allPokemonName,null,['class' => 'form-control','multiple'=>true]) !!}
                            {{--<select name = "addPokemon" class="form-control" multiple="true">
                                @foreach($pokemon as $poke)
                                    <option value="{{$poke->name}}">{{$poke->name}}</option>
                                @endforeach
                            </select>--}}
                        </div>

                        <div class="form-group">
                            @if(($currentUser->id == $user->id))
                                {!! Form::submit('Edit',['class' => 'btn btn-primary form-control']) !!}
                            @elseif(($currentUser->profile) and ($currentUser->profile->isAdmin))
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