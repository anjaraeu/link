<?php

namespace App\Http\Controllers;

use App\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ShortLinkController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     //
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createlink');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required|url'
        ]);
        $passwd = hash('sha256', random_bytes(50));
        $link = ShortLink::create([
            'link' => $request->input('link'),
            'slug' => substr(sha1(random_bytes(25)), 0, 6),
            'deletepasswd' => Hash::make($passwd)
        ]);
        return response()->json(['deletelink' => url('delete/'.$link->id.'/'.$passwd), 'link' => url($link->slug)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $link = ShortLink::where('slug', $slug)->get()->first();
        if (empty($link)) { return abort(404); }
        return redirect($link->link);
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\ShortLink  $shortLink
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(ShortLink $shortLink)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\ShortLink  $shortLink
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, ShortLink $shortLink)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShortLink  $shortLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShortLink $shortLink, $passwd)
    {

    }
}
