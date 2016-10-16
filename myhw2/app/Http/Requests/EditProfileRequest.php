<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class EditProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->id,
            'hometown' => 'required|string|max:255'

        ];
        if($this->input('addPokemon')) {
            foreach ($this->input('addPokemon') as $id) {
                if (Auth::user()->pokemon->where('id', $id)->count() > 0) {
                    $rule['addPokemon'] = 'unique:pokemon,id';
                    break;
                }
            }
        }
        return $rule;
    }

}
