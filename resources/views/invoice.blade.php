<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Reservation Invoice</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />
    <style>
        @media print {
            @page {
                size: A4;
            }
        }

        body {
            font-family: "Inter", sans-serif;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .inv-header,
        .inv-body,
        .inv-footer {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        table th {
            text-align: left;
        }

        .inv-footer {
            text-align: right;
        }

        .inv-footer table {
            width: auto;
        }

        .inv-footer table th {
            padding-right: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Reservation Invoice</h1>
        <div class="inv-header">
            <div>
                <h2 style="color: #ff9b00;">SwiftDrive</h2>
                <p>Matthew Manamtam</p>
                <p>+212637998660 | swiftdrive@@gmail.com</p>
            </div>
            <div>
                <h2>Client</h2>
                <p>{{ $reservation->user->name }}</p>
                <p>{{ $reservation->user->email }}</p>
            </div>
        </div>
        <div class="inv-body">
            <table>
                <thead>
                    <tr>
                        <th>Car</th>
                        <th>Start date</th>
                        <th>End date</th>
                        <th>Duration</th>
                        <th>Price per day</th>
                        <th>Reservation price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <h4>{{ $reservation->car->brand }} {{ $reservation->car->model }}</h4>
                            <p>{{ $reservation->car->engine }}</p>
                        </td>
                        <td>{{ $reservation->start_date }}</td>
                        <td>{{ $reservation->end_date }}</td>
                        <td>{{ $reservation->days }}</td>
                        <td>₱{{ $reservation->price_per_day }}</td>
                        <td>₱{{ $reservation->total_price }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="inv-footer">
            <table>
                <tr>
                    <th>Subtotal</th>
                    <td>₱{{ $reservation->total_price }}</td>
                </tr>
                <tr>
                    <th>Tax (15%)</th>
                    <td>₱{{ intval($reservation->total_price * 0.15) }}</td>
                </tr>
                <tr>
                    <th style="color: #ff9b00;">Total to pay</th>
                    <td>₱{{ intval($reservation->total_price * 1.15) }}</td>
                </tr>
            </table>
        </div>
        <p style="text-align: center;">Thank you for trusting us!</p>
    </div>
</body>

</html>

