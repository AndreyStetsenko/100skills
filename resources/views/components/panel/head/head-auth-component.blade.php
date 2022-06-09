<meta charset="UTF-8">
<title>{{ $meta['title'] ?? (config('app.name') . ' вход в личный кабинет') }}</title>
<meta name="description" content="{{ $meta['description'] ?? (config('app.name') . ' вход в личный кабинет') }}" />
<meta name="keywords" content="{{ $meta['keywords'] ?? (config('app.name') . ' вход в личный кабинет') }}" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="/public/css/app.panel.css?v=1.<?=time() ?>">
<link rel="stylesheet" href="/public/css/custom.panel.css?v=1.<?=time() ?>">
<script src="/public/js/app.panel.js"></script>

<link rel="stylesheet" href="/resources/fonts/panel/Montserrat/style.css">


  <!-- Swiper JS -->
<style>
  *{
    font-family: "Montserrat-Regular";
  }
  b{
    font-family: "Montserrat-Medium";
  }
</style>