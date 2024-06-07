@extends('templates.multilink-page')

@php
    function EchoTrack($track)
    {
        $url = "";
        if($track == null) return;
        if($track->route != null) $url = $track->route->url;
        $type = "";
        if($track->type == 1) $type = "альбом";
        echo'
    	<div class="service">
    		<a class="img-btn redirect" href="https://'.$url.'" data-player="vk" data-servicetype="play" data-apptype="manual">
    			<span><img class="" width="45px" height="45px" style="display:inline-block;" src="https://'.$track->img_url.'" alt="vk"></span>
    			<strong> '.$track->name.'</strong> '.$type.'
    			<span class="play">Перейти</span>
    		</a>
    	</div>';
    }
    function EchoLink($link)
    {
        preg_match('/([a-z]+)\(([а-яА-Яa-zA-Z0-9-_=?.|\\/]+)\)/u', $link->url, $match);
        if($match != null)
        {
            switch($match[1])
            {
                case 'vk':
                    $btn['url'] = 'vk.com/'.$match[2];
                    $btn['social'] = 'vk';
                    $btn['icon'] = 'fa-vk';
                    break;
                case 'yt':
                    $btn['url'] = 'www.youtube.com/'.$match[2];
                    $btn['social'] = 'youtube';
                    $btn['icon'] = 'fa-youtube';
                    break;
                case 'x':
                    $btn['url'] = 'twitter.com/'.$match[2];
                    $btn['social'] = 'twitter';
                    $btn['icon'] = 'fa-twitter';
                    break;
                case 'insta':
                    $btn['url'] = 'www.instagram.com/'.$match[2];
                    $btn['social'] = 'instagram';
                    $btn['icon'] = 'fa-instagram';
                    break;
                case 'fb':
                    $btn['url'] = 'www.facebook.com/'.$match[2];
                    $btn['social'] = 'facebook';
                    $btn['icon'] = 'fa-facebook';
                    break;
            }
            return '<div class="social '.$btn['social'].'"><a href="https://'.$btn['url'].'" target="_blank"><i class="fa '.$btn['icon'].' fa-2x"></i></a></div>';
        }
        return 'Error load element (artist.blade.php/divlink)';
    }
@endphp

@section('head')
	<title>{{ $artist->name }}</title>
	<meta name="description" content="{{ $artist->name }}">
	<meta property="og:title" content="{{ $artist->name }}">
	<meta property="og:description" content="{{ $artist->name }}">
	<meta property="og:url" content="https://lnk-to.ru">
	<meta property="og:image" content="https://{{ $artist->img_url }}">
	<meta name="twitter:url" value="https://lnk-to.ru">
	<meta name="twitter:title" content="{{ $artist->name }}">
	<meta name="twitter:description" content="{{ $artist->name }}">
	<meta name="twitter:image" content="https://{{ $artist->img_url }}">
@endsection

@section('main')
    <div id="bg">
    	<img src="https://{{ $artist->img_url }}" alt="">
    </div>
    
    <div id="img" class="imagecontainer" style="position:relative">
    	<img src="https://{{ $artist->img_url }}" alt="">
    </div>
    
    <div id="header" class="service-container sticky" style="z-index:9000; ">
    	<div class="header">
    		<h1 class="artist">{{ $artist->name }}</h1>
    		<p class="where">Выбрать трек/альбом</p>
    	</div>
    	<div class="arrow"></div>
    </div>
    <div class="hideme" style="display:none;z-index:1"></div>
    <div id="service" class="service-container">
        @foreach($tracks as $track)
            @php EchoTrack($track); @endphp
        @endforeach
    	<div class="service" style="padding: 0px 25px !important">
    	<font size="1px" color="white" face="Arial">{{ $artist->name }}</font>
    	@foreach($links as $link)
            @php echo EchoLink($link); @endphp
        @endforeach
    	<font size="1px" color="white" face="Arial">{{ $artist->name }}</font>      
    </div>
@endsection