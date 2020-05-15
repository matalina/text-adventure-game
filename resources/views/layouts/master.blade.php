<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Text Adventure Game</title>

    <!-- Fonts -->
    <script src="https://kit.fontawesome.com/fa9d950b68.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=PT+Sans&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ url('css/app.css') }}" />
    <livewire:styles />
</head>
<body>
    @yield('body')

    <script src="{{ url('js/app.js') }}"></script>
    <livewire:scripts />
</body>
</html>
