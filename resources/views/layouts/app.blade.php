<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Product App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #eaf3ff; /* pastel blue */
            font-family: "Inter", sans-serif;
        }

        .top-welcome-bar {
            background: #f7e9a8;
            padding: 14px;
            text-align: center;
            font-size: 22px;
            color: #364f85;
            font-weight: 600;
            letter-spacing: 0.3px;
            margin-bottom: 25px;
        }

    
        .welcome-only {
            display: block;
        }

       
        body.page-products .welcome-only {
            display: none;
        }

        body.hide-welcome .welcome-header {
            display: none;
        }

       
        .soft-card {
            background: white;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.08);
        }

        .table thead th {
            background: #90bfff; 
            border-bottom: 2px solid #d0d8f0;
        }

        .table td, .table th {
            border: 1px solid #d6def5 !important;
            vertical-align: middle;
        }

    </style>
</head>

<body class="@yield('page_class')">

    
    <div class="top-welcome-bar welcome-header">
    Welcome to School Product App
</div>

    <div class="container pb-5">
        {{ $slot }}
    </div>

</body>
</html>
