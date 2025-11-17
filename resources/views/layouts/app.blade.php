<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>School Product App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #e7f4ff; /* biru pastel */
        }

        .navbar {
            background: #ffefb0 !important; /* kuning pastel */
        }

        .card {
            background: white;
            border-radius: 12px;
            border: 1px solid #d7e5ff;
        }

        .btn-primary {
            background-color: #7ab8ff !important;
            border: none;
        }

        .btn-warning {
            background-color: #ffe28a !important;
            border: none;
        }
    </style>

</head>
<body>

<nav class="navbar p-3 shadow-sm">
    <h4 class="m-auto fw-bold" style="color:#6b92ff;">Welcome to School Product App</h4>
</nav>

<div class="container py-4">
    {{ $slot }}
</div>

</body>
</html>
