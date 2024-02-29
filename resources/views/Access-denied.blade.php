<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Access Denied</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #333;
            color: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            position: relative;
        }

        h1, h3, h6 {
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        h1 {
            font-size: 2.5rem;
            color: #ff4a4a;
            animation: slideDown 1s ease;
        }

        h6 {
            color: #ccc;
            font-weight: 400;
        }

        div {
            text-align: center;
            max-width: 80%;
        }

        hr {
            margin: 20px auto;
            border: 0;
            height: 1px;
            background: rgba(255,255,255,0.2);
            width: 50%;
        }

        @keyframes slideDown {
            0% {
                transform: translateY(-50px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

    </style>
</head>
<body>
    <div>
        <h1>Access Denied</h1>
        <hr>
        <h3>You don't have permission to view this site.</h3>
        <h3>🚫</h3>
        <h6>Error Code: 403 forbidden</h6>
    </div>
</body>
</html>
