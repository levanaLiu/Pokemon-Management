<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EditPokemonRequest;

use App\Http\Requests;
use App\Pokemon;

use Auth;
use DB;

class PokemonController extends Controller
{
    //
    public function index(EditPokemonRequest $request){
        $totalNum = 0;
        $pokemon = Pokemon::all();
        foreach($pokemon as $poke){
            $totalNum = $totalNum + $poke->users->count();
        }
        $currentUser = Auth::user();
        $currentPokemonName = Pokemon::all()->pluck('name','id');
        return view('pokemon.index',compact(['currentUser','pokemon','totalNum','currentPokemonName']));
    }

    public function edit(EditPokemonRequest $request){
        if($request->addPokemon){
            DB::table('pokemon')->insert([
                'name' => $request->addPokemon
            ]);
        }

        if( $request->get('deletePokemon')) {
            foreach ($request->get('deletePokemon') as $pokeId) {
                DB::table('pokemon')->where([
                    ['id', '=', $pokeId]
                ])->delete();
            }
        }

        flash("Edit successfully","info");
        return redirect(url('admin'));
    }

    public function search($name)
    {
        $currentUser= Auth::user();
        if(DB::table('pokemon')->where('name','=',$name)->first()){
            $id = DB::table('pokemon')->where('name','=',$name)->first()->id;
            if($id){
                $users = Pokemon::find($id)->users;
                $number = Pokemon::find($id)->users->count();
            }
        }
        else {
            $users = null;
            $number = 0;
        }


        return view('pokemon.search',compact('name','currentUser','users','number'));



    }
}
