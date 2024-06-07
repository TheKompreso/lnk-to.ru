@extends('templates.multilink-page')

@php
    use App\Models\Artist;

    function EchoLink($link) : string
    {
        preg_match('/([a-z]+)\(([а-яА-Яa-zA-Z0-9-_=?.|\\/]+)\)/u', $link->url, $match);
        if($match != null)
        {
            switch($match[1])
            {
                case 'apple':
                    $btn['url'] = 'music.apple.com/ru/album/'.$match[2].'?app=music&l=ru';
                    $btn['text'] = 'Слушай';
                    $btn['img'] = 'lnk-to.ru/images/service/music-service_applemusic.svg';
                    break;
                case 'itunes':
                    $btn['url'] = 'music.apple.com/ru/album/'.$match[2].'?app=itunes&l=ru';
                    $btn['text'] = 'Загружай';
                    $btn['img'] = 'lnk-to.ru/images/service/music-service_itunes.svg';
                    break;
                case 'boomid':
                    $btn['url'] = 'boom.ru/redirect/album/'.$match[2];
                    $btn['text'] = 'Слушай';
                    $btn['img'] = 'lnk-to.ru/images/service/music-service_boom.svg';
                    break;
                case 'boom':
                    $btn['url'] = 'share.boom.ru/album/'.$match[2];
                    $btn['text'] = 'Слушай';
                    $btn['img'] = 'lnk-to.ru/images/service/music-service_boom.svg';
                    break;
                case 'yamusic':
                    $btn['url'] = 'music.yandex.ru/album/'.$match[2];
                    $btn['text'] = 'Слушай';
                    $btn['img'] = 'lnk-to.ru/images/service/music-service_yandexmusic.svg';
                    break;
                case 'vk':
                    $btn['url'] = 'vk.com/'.$match[2];
                    $btn['text'] = 'Слушай';
                    $btn['img'] = 'lnk-to.ru/images/service/music-service_vk.svg';
                    break;
                case 'gplay':
                    $btn['url'] = 'play.google.com/store/music/album/?id='.$match[2];
                    $btn['text'] = 'Загружай';
                    $btn['img'] = 'lnk-to.ru/images/service/music-service_google.svg';
                    break;
                case 'spotify':
                    $btn['url'] = 'open.spotify.com/album/'.$match[2];
                    $btn['text'] = 'Загружай';
                    $btn['img'] = 'lnk-to.ru/images/service/music-service_spotify.svg';
                    break;
                case 'deezer':
                    $btn['url'] = 'www.deezer.com/ru/album/'.$match[2];
                    $btn['text'] = 'Слушай';
                    $btn['img'] = 'lnk-to.ru/images/service/music-service_deezer.svg';
                    break;
                case 'genius':
                    $btn['url'] = 'genius.com/'.$match[2];
                    $btn['text'] = 'Текст';
                    $btn['img'] = 'lnk-to.ru/images/service/music-service_genius.svg';
                    break;
                default:
                    preg_match('/([^|]+)\|([^|]+)\|([^|]+)/u', $match[2], $output_array);
                    if($output_array == null || (count($output_array) != 3)) return 'Arguments error (track.blade.php/divlink)';
                    $btn['url'] = $output_array[1];
                    $btn['text'] = $output_array[2];
                    $btn['img'] = $output_array[3];
                    break;
            }
            return '<div class="service">				  
				<a class="img-btn redirect" href="https://'.$btn['url'].'">
				<span><img class="" width="125px" height="40px" style="display:inline-block;" src="https://'.$btn['img'].'"></span>
				<span class="play">'.$btn['text'].'</span></a></div>';
        }
        return 'Error load element (track.blade.php/divlink)';
    }
    function ArtistsName($string)
    {
        preg_match_all('/\[([0-9]+)\]\(([a-zA-Z0-9_!]*)\)/', $string, $output_array);
        if(count($output_array) > 0 && count($output_array[0]) > 0)
        {
            for($i = 0; $i < count($output_array[0]); $i++)
            {
        		$artist = Artist::where('id', $output_array[1][$i])->first();
        		if($artist == null)
        		{
        		    $output_array[2][$i] = "ARTIST_ERROR";
        		    $output_array[3][$i] = "ARTIST_ERROR";
                }
                if($output_array[2][$i] == "")
                {
        		    $output_array[2][$i] = $artist->name;}
        		    $route = $artist->route;
        		    if($route == null) $output_array[3][$i] = "ROUTE_ERROR";
        		    else $output_array[3][$i] = $route->url;
                
            }
        }
        
        $array['clear'] = $string;
        $array['links'] = $string;
        for($i = 0; $i < count($output_array[0]); $i++)
        {
            $array['clear'] = preg_replace('/\['.$output_array[1][$i].']\(([a-zA-Z0-9_!]*)\)/', $output_array[2][$i], $array['clear']);
            $array['links'] = preg_replace('/\['.$output_array[1][$i].']\(([a-zA-Z0-9_!]*)\)/', '<a href="https://'.$output_array[3][$i].'">'.$output_array[2][$i].'</a>', $array['links']);
        }
        return $array;
    }
    $artists = ArtistsName($track->artist);
@endphp

@section('head')
	<title>{{ $artists['clear'] }} - {{ $track->name }}</title>
	<meta name="description" content="{{ $artists['clear'] }} - {{ $track->name }}">
	<meta property="og:title" content="{{ $artists['clear'] }} - {{ $track->name }}">
	<meta property="og:description" content="{{ $artists['clear'] }} - {{ $track->name }}">
	<meta property="og:url" content="https://lnk-to.ru">
	<meta property="og:image" content="https://{{ $track->img_url }}">
	<meta name="twitter:url" value="https://lnk-to.ru">
	<meta name="twitter:title" content="{{ $artists['clear'] }} - {{ $track->name }}">
	<meta name="twitter:description" content="{{ $artists['clear'] }} - {{ $track->name }}">
	<meta name="twitter:image" content="https://{{ $track->img_url }}">
@endsection

@section('main')
	<div id="bg">
		<img src="https://{{ $track->img_url }}" alt="">
	</div>

	<div id="img" class="imagecontainer" style="position:relative">
		<img src="https://{{ $track->img_url }}" alt="">
	</div>

	<div id="header" class="service-container sticky" style="z-index:9000; ">
		<div class="header">
			<h1 class="artist">@php print($artists['links']); @endphp - {{ $track->name }}</h1>
			<p class="where">Выбрать трек/альбом</p>
		</div>
		<div class="arrow"></div>
	</div>
	<div class="hideme" style="display:none;z-index:1"></div>
	<div id="service" class="service-container">
		@foreach($links as $link)
            @php print(EchoLink($link)); @endphp
        @endforeach
		<font size="1px" color="white" face="Arial">{{ $artists['clear'] }} - {{ $track->name }}</font>      
	</div>
@endsection