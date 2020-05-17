<?php

namespace App\Http\Controllers\Link;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLinkRequest;
use App\Models\Link;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function generate(CreateLinkRequest $request)
    {
        $url = $request->get('url');
        $code = null;

        if (Link::where('url', $url)->exists()) {
            $existLink = Link::where('url', $url)->first();
            $code = $existLink->code;
        } else {
            $created = Link::create([
                'title' => $request->title,
                'url' => $url,
                'code' => 0
            ]);
            if ($created) {
                $code = base_convert($created->id, 10, 36);

                Link::where('id', $created->id)->update([
                    'code' => $code
                ]);
            }
        }
        if ($code) {

//            return $this->returnUrl($code);
            return redirect()->back()->with('global', route('url.showRedirect', $code));
        }
        return redirect()->back()->with('global', 'error, try again');

    }

    public function showRedirect($code)
    {

        if (Link::where('code', $code)->exists()) {
            $link = Link::where('code', $code)->first();

            $link->increment('visits', 1);
            return view('shorten.redirect', compact('link'));
        }
        abort(404);


    }

    public function returnUrl($code)
    {
        return redirect()->back()->with('global', url($code));
    }
}
