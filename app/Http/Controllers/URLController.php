<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Artist;
use App\Models\Track;
use App\Models\Link;
use App\Models\Route;

class URLController extends Controller
{
    public function LoadPage($domain, $url = null)
    {
        $routeModel = Route::where('url', $domain.'/'.$url)->first();
        if($routeModel == null)
        {
            if($domain == env('APP_URL')) abort('404');
            $routeModel = Route::where('url', $domain.'/')->first();
            if($routeModel == null) abort('404');
            return redirect()->route('route', ['domain' => $domain]);
        }
        switch($routeModel->type){
            case 0: return URLController::LoadLink($routeModel->object_id);
            case 1: return URLController::LoadArtist($routeModel->object_id);
            case 2: return URLController::LoadTrack($routeModel->object_id);
        }
        abort('409');
    }
    
    public function LoadArtist($artist_id)
    {
		$artist = Artist::where('id', $artist_id)->first();
		if($artist == null) abort('409');
		$tracks = $artist->GetTracks();
		$links = $artist->links;
		
        return view('artist', [
            'artist' => $artist,
            'tracks' => $tracks,
            'links' => $links,
        ]);
    }
    public function LoadTrack($track_id)
    {
		$track = Track::where('id', $track_id)->first();
		if($track == null) abort('409');
		$links = $track->links;
		
        return view('track', [
            'track' => $track,
            'links' => $links,
        ]);
    }
    public function LoadLink($link_id)
    {
        $link = Link::where('id', $link_id)->first();
		if($link == null) abort('409');
		return redirect()->away('https://'.$link->url);
    }
}
