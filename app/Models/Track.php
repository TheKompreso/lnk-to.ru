<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Route;
use App\Models\TrackLink;

class Track extends Model
{
    use HasFactory;
	protected $with = ['route'];
    
    //public $timestamps = false;
    //protected $fillable = ['name','image_url', 'platform', 'release_date'];
    
	public function links()
	{
		return $this->hasMany(TrackLink::class);
	}
	
    public function route()
    {
		return $this->belongsTo(Route::class);
    }
}
