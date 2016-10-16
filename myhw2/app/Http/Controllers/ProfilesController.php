<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\EditProfileRequest;
use App\Profile;
use App\Pokemon;
use App\User;
use Auth;
use DB;


class ProfilesController extends Controller
{
    //
    public function index($id){

        $user = User::find($id);
        $currentUser = Auth::user();
        $currentPokemonName = User::find($id)->pokemon->pluck('name','id');
        $allPokemonName = Pokemon::orderBy('name')->pluck('name','id');
        if(!$currentUser->profile and $currentUser->id==$user->id)
        {
            flash('Please fulfill your profile','warning');
        }
        return view('profile.index',compact('user','currentUser','currentPokemonName','allPokemonName'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit(EditProfileRequest $request, $id)
    {
        DB::table('users')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
        if(User::find($id)->profile) {
            DB::table('profiles')->where('user_id', $id)->update([
                'hometown' => $request->hometown
            ]);
        }
        else{
            DB::table('profiles')->insert([
                'user_id' => $id,
                'hometown' => $request->hometown,
                'isAdmin' => 0
            ]);
        }
        if( $request->get('deletePokemon')) {
            foreach ($request->get('deletePokemon') as $pokeId) {
                DB::table('pokemon_user')->where([
                    ['user_id', '=', $id],
                    ['pokemon_id', '=', $pokeId]
                ])->delete();
            }
        }

        if( $request->get('addPokemon') ) {
            foreach ($request->get('addPokemon') as $pokeId) {
                DB::table('pokemon_user')->insert([
                    'user_id' => $id,
                    'pokemon_id' => $pokeId
                ]);
            }
        }

        flash("Edit successfully","info");
        return redirect(url('profile',$id));
    }
}
