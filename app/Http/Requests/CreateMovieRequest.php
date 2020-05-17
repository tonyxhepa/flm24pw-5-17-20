<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMovieRequest extends FormRequest
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
        return [
            'tmdb_id'=> 'required',
            'title'=> 'required',
            'release_date'=> 'required|date|date_format:Y-m-d',
            'runtime'=> 'required',
            'lang'=>'required',
            'video_format'=>'required',
            'rating'=> 'required',
            'overview'=> 'required',
            'poster_path'=> 'required',
        ];
    }
}
