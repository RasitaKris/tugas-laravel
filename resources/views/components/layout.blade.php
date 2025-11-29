<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Product App</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Global background pastel */
        body {
            background: #e8f1ff !important;
        }
    </style>
</head>

<body>

    {{-- Jika sedang di halaman welcome, tampilkan banner welcome --}}
    @if(request()->is('/'))
        <div style="
            background: #fdeeb3;
            padding: 18px;
            text-align: center;
            font-size: 20px;
            font-weight: 600;
            color: #2a3d66;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        ">
            Welcome to School Product App
        </div>
    @endif

    <div class="container py-4">
        {{ $slot }}
    </div>

</body>
</html>
