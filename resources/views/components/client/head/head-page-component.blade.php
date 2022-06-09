<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ $meta['title'] ?? config('app.name') }}</title>
<meta name="description" content="{{ $meta['description'] ?? config('app.name') }}" />
<meta name="keywords" content="{{ $meta['keywords'] ?? config('app.name') }}" />

<!-- custom styles -->
<link rel="stylesheet" href="/resources/css/client/max/bootstrap-grid.min.css">
<link rel="stylesheet" href="/resources/css/client/max/uikit.min.css">
<link rel="stylesheet" href="/resources/css/client/max/main.css">
<link rel="stylesheet" href="/resources/css/client/max/custom.style.css?v=1.<?=time() ?>">

<!-- custom scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="/resources/js/client/max/uikit.min.js"></script>
<script src="/resources/js/client/max/uikit-icons.min.js"></script>
<script src="/resources/js/client/max/main.js"></script>
<link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">
<!-- <script src="/resources/js/client/max/jquery-2.1.1.js"></script> -->
<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js" crossorigin="anonymous"></script> -->
<script type="text/javascript" src="/resources/js/client/max/jquery.uploadPreview.min.js"></script>

<!-- custom скрипт только для работы фильтра в каталоге -->
<script src="/resources/js/client/max/custom.script.js"></script>