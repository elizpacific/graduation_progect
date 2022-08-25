<html>
<head>
{{--    <title>{{ $title }}</title>--}}
    <style>
        .italic {
            font-style: italic;
        }
        .bold {
            font-weight: bold;
        }
        .color-red {
            color: red;
        }
    </style>
</head>
<body>
{{--<h1>{{ $title }}</h1>--}}

@if ($errors->any())
    <div>
        <ul class="color-red">
            @foreach($errors->all() as $error)
                <li> {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{ $slot }}
</body>
</html>
