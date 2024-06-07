@php
    use Carbon\Carbon;
@endphp

<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=0.80">
	
	<!--- https://pr-cy.ru/favicon/ - отличный сайт для иконок --->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}" />
    <link rel="manifest" href="{{ asset('site.webmanifest') }}" />
    
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta property="og:type" content="article">
	<meta name="twitter:card" content="summary_large_image">
	<link rel="stylesheet" href="{{ asset('css/songpage.css?d=24761221') }}">
	<style>#main, #main .imagecontainer img, #main #header {width: 341px;}</style>
	<link rel="stylesheet" href="{{ asset('css/social.css') }}">
	@yield('head')
</head>

<body>
	<div id="main">
	    @yield('main')
		<div id="header" class="service-container sticky" style="z-index:9000; ">
			<div style="line-height: 2.445em" class="header">
				<h1 class="artist" style="margin-bottom: 7px">Поддержать проект lnk-to.ru</h1>	 
				<!---<a class="btn btn-warning" href="https://qiwi.com/n/MICKRIZE" role="button" > <input type="image" width="15px" height="15px" src="https://lnk-to.ru/service_images/qiwi.png"> Qiwi</a>--->
				<a class="btn btn-warning" href="https://yoomoney.ru/to/410012146703255" role="button" > <input type="image" width="15px" height="15px" src="{{ asset('images/service/yandexmoney.png') }}"> Яндекс деньги</a> 
				<font style="display: block;" size="0" color="white" face="Arial"><a href="https://lnk-to.ru">lnk-to.ru</a> © 2019-{{Carbon::today()->year}}</font> 
			</div>
		</div>
	</div>
</body>