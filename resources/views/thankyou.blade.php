<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thank you</title>
    @vite('resources/css/app.css')
    <link rel="icon" type="image/x-icon" href="/images/logos/logotext.png">
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f3f4f6;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 0 20px;
        }

        .card {
            background-color: #fff;
            width: 80%;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
            border: 1px solid #e5e7eb;
        }

        .card img {
            width: 100px;
            margin-bottom: 20px;
        }

        .card h1 {
            font-size: 2.5rem;
            color: #4b5563;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 1.1rem;
            color: #6b7280;
            margin-bottom: 30px;
        }

        .next-step {
            background-color: #f3f4f6;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            padding: 20px;
            margin-top: 30px;
        }

        .next-step h2 {
            font-size: 1.5rem;
            color: #4b5563;
            margin-bottom: 10px;
        }

        .next-step p {
            font-size: 1.1rem;
            color: #6b7280;
            margin-bottom: 20px;
        }

        .next-step a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #000;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .next-step a:hover {
            background-color: #333;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <img src="/images/logos/logotext.png" alt="Logo">
            <h1>Thank You!</h1>
            <p>It's a great pleasure to serve you. We've got your journey covered! 😎🚗</p>
            <div class="next-step">
                <h2>Next Step:</h2>
                <p>You can check your reservation info and present it to us as you claim your reservation.</p>
                <a href="{{route('clientReservation')}}">Proceed to Reservations &rarr;</a>
            </div>
        </div>
    </div>
</body>

</html>
