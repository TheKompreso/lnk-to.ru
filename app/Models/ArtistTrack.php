<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Track;

class ArtistTrack extends Model
{
    use HasFactory;
    
	public function track()
	{
		return $this->belongsTo(Track::class);
	}
}
