<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSeasonRequest;
use App\Http\Resources\Admin\AdminSeasonResource;
use App\Models\Season;
use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiSeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Serie $serie)
    {
        $seasons =  $serie->seasons;

        return AdminSeasonResource::collection($seasons);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illumainate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Serie $serie, CreateSeasonRequest $request)
    {

        $contents = file_get_contents($request->poster_path);
        $name = substr($request->poster_path, strrpos($request->poster_path, '/') + 1);
        $save = Storage::put('public/serie/season/'.$name, $contents);
        if ($save){
            $serie->seasons()->create([
                'tmdb_id' => $request->tmdb_id,
                'name' => $request->name,
                'season_number' => $request->season_number,
                'poster_path' => '/'.$name,
            ]);
            return response('Created');
        }else{
            return response('Not created');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Serie $serie, $slug)
    {

        $season = $serie->seasons->where('slug', $slug)->first();
        $name = substr($request->poster_path, strrpos($request->poster_path, '/') + 1);
        if ($name === $season->poster_path){
            $season->update([
                'tmdb_id' => $request->tmdb_id,
                'name' => $request->name,
                'season_number' => $request->season_number,
                'poster_path' => $name,
            ]);
            return response('Updated ');
        }else{
            $contents = file_get_contents($request->poster_path);
            Storage::delete('public/serie/season/'. $serie->poster_path);
            $save = Storage::put('public/serie/season/'.$name, $contents);
            if ($save){
                $season->update([
                    'tmdb_id' => $request->tmdb_id,
                    'name' => $request->name,
                    'season_number' => $request->season_number,
                    'poster_path' => '/'.$name,
                ]);
                return response('Created and File Stored');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Serie $serie, $slug)
    {
        $season = Season::where('slug', $slug)->first();
        Storage::delete('public/serie/season/'. $season->poster_path);
        $season->delete();

        return response('u fshije');
    }
}
