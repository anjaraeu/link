<?php

namespace App\Http\Controllers\Api;

use App\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\ShortLink as ResShortLink;

class ShortLinkController extends Controller
{

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
        return response()->json(['deletelink' => url('api/link/'.$link->id.'?passwd='.$passwd), 'link' => url($link->slug)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(ShortLink $shortLink)
    {
        return new ResShortLink($shortLink);
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
    public function destroy(Request $request, ShortLink $shortLink)
    {
        if (Hash::check($request->input('passwd'), $shortLink->deletepasswd)) {
            $shortLink->delete();
            return response()->json(true);
        }
    }
}
