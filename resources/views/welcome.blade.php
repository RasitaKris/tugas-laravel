<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Product App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(180deg, #f7faff 0%, #e8f1ff 100%);
            font-family: "Inter", sans-serif;
            padding-top: 50px;
        }

        .top-banner {
            background: #ffe9a8;
            padding: 14px;
            font-weight: 700;
            font-size: 18px;
            text-align: center;
            border-bottom: 2px solid #ffdc7d;
            color: #2a3d66;
        }

        .title-block {
            text-align: center;
            margin-top: 40px;
        }

        .school-name {
            font-size: 36px;
            font-weight: 800;
            color: #2a4ea3;
            line-height: 1.2;
        }

        .motto {
            font-size: 18px;
            margin-top: 10px;
            color: #cf8a00;
            font-weight: 600;
        }

        .welcome-card {
            max-width: 700px;
            margin: 40px auto;
            background: #ffffff;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
            text-align: center;
        }

        .welcome-text {
            font-size: 17px;
            color: #3c4b66;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .btn-main {
            background: #90bfff;
            border: none;
            padding: 12px 22px;
            font-size: 17px;
            border-radius: 12px;
            font-weight: 600;
        }

        .btn-main:hover {
            background: #76aef3;
        }
    </style>
</head>

<body>

    <div class="top-banner">
        Welcome to School Product App
    </div>

    <div class="title-block">
        <div class="school-name">
            PKBM Bread of Life<br>
            Adventist Homeschooler Community
        </div>

        <div class="motto">“Nurture Together, Grow Together”</div>
    </div>

    <div class="welcome-card">
        <p class="welcome-text">
            Welcome to our school’s platform for managing tuition payments and exploring
            educational products provided by the school in a simple and convenient way.
        </p>

        <a href="{{ route('products') }}" class="btn btn-main">
            Go to Product List
        </a>
    </div>

</body>
</html>
