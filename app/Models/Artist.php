<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ArtistLink;
use App\Models\ArtistTrack;
use App\Models\Track;
use App\Models\Route;

class Artist extends Model
{
	protected $with = ['links', 'route'];
    use HasFactory;
	
    public function route()
    {
		return $this->belongsTo(Route::class);
    }
	public function links()
	{
		return $this->hasMany(ArtistLink::class);
	}
	public function GetTracks()
	{
	    $list = $this->artisttracks;
	    $array = [];
		foreach ($list as $track) {
			array_push($array, $track->track);
		}
		return Collection::make($array);
	}
	public function artisttracks()
	{
	    return $this->hasMany(ArtistTrack::class)->orderBy('release_date', 'DESC');
	}
}
