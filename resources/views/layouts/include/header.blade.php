<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Timesheet System</title>
    <meta name="description" content="Dashboard UI Kit">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600" rel="stylesheet">

    <!-- Favicon -->
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="{{ asset("/img/logo11.png") }}">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/toastr/toastr.min.css') }}">
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/timepicker.css') }}">
    <script src="{{ asset('js/timepicker.js') }}"></script>

    
    @if (!empty($css)) 
    @foreach ($css as $value) 
    <link rel="stylesheet" href="{{ asset('css/'.$value) }}">
    @endforeach
    @endif
    <script>
        var baseurl = "{{ asset('/') }}";
    </script>
</head>