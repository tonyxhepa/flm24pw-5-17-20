<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateGenreRequest;
use App\Http\Resources\Admin\AdminGenreResource;
use App\Models\Genre;
use Illuminate\Http\Request;

class ApiGenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genre::all();

        return AdminGenreResource::collection($genres);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illumainate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGenreRequest $request)
    {
        $genre = new Genre;
        $genre->tmdb_id = $request->tmdb_id;
        $genre->title = $request->title;
        $genre->save();

        return response()->json(['success'=>'Created']);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $genre = Genre::where('slug', $slug)->first();
        $genre->update([
            'tmdb_id' => $request->tmdb_id,
            'title' => $request->title,
        ]);
        return response()->json(['success'=>'Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $genre = Genre::where('slug', $slug)->first();
        $genre->delete();

        return response('u fshije');
    }
}
