<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTagRequest;
use App\Http\Resources\Admin\AdminTagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class ApiTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();

        return AdminTagResource::collection($tags);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illumainate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagRequest $request)
    {
        $tag = new Tag;
        $tag->tag_name = $request->tag_name;
        $tag->save();

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
        $tag = Tag::where('slug', $slug)->first();
        $tag->update([
            'tag_name' => $request->tag_name,
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
        $tag = Tag::where('slug', $slug)->first();
        $tag->delete();

        return response('u fshije');
    }
}
