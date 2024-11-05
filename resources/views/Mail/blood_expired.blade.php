<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expired Blood Inventory Notification</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #c0392b;
            text-align: center;
        }
        p {
            color: #333;
            font-size: 16px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background-color: #ecf0f1;
            margin: 10px 0;
            padding: 10px;
            border-radius: 4px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #aaaaaa;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Expired Blood Inventory</h2>
        <p>The following blood units have expired:</p>
        <ul>
            @foreach($expiredBlood as $blood)
                <li>
                    <strong>Blood Type:</strong> {{ $blood['blood_group'] }}<br>
                    <strong>Quantity:</strong> {{ $blood['quantity'] }}<br>
                    <strong>Expired On:</strong> {{ $blood['expiry_date'] }}
                </li>
            @endforeach
        </ul>
        <div class="footer">
            <p>© {{ date('Y') }} Blood Donation. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
