<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ $meta['title'] ?? config('app.name') }}</title>
<meta name="description" content="{{ $meta['description'] ?? config('app.name') }}" />
<meta name="keywords" content="{{ $meta['keywords'] ?? config('app.name') }}" />

<!-- custom styles -->
<link rel="stylesheet" href="/resources/css/client/max/normalize.css">
<link rel="stylesheet" href="/resources/fonts/client/Montserrat/style.css">
<link rel="stylesheet" href="/resources/css/client/max/style.basic.css?1.1<?=time() ?>">
<link rel="stylesheet" href="/resources/css/client/max/style.custom.css?1.1<?=time() ?>">
<link rel="stylesheet" href="/resources/css/client/max/style.responsive.css?1.1<?=time() ?>">


<!-- custom scripts -->
<script src="/resources/js/client/max/script.functions.js?v=1.<?=time();?>"></script>
<script src="/resources/js/client/max/script.loaded.js?v=1.<?=time();?>"></script>