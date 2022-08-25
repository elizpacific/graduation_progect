<html>
<head>
    <title>{{ $title }}</title>
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
<h1>{{ $title }}</h1>

{{ $slot }}

</body>
</html>
