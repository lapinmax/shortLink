<?php

namespace App\Http\Controllers;

use App\ShortLink;
use Illuminate\Http\Request;

class ShortLinkController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $shortLinks = ShortLink::latest()->get();

        return view('shortenLink', compact('shortLinks'));
    }

    /**
     * @param Request $request
     *
     * @return $this
     */
    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required|url'
        ]);

        $input['link'] = $request->link;
        $input['code'] = str_random(6);

        ShortLink::create($input);

        return redirect('generate-shorten-link')
            ->with('success', 'Shorten Link Generated Successfully!');
    }

    /**
     * @param $code
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function shortenLink($code)
    {
        ShortLink::where('code', $code)->first();

        return redirect('/');
    }

}
