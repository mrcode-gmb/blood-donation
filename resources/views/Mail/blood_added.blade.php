<!DOCTYPE html>
<html>

<head>
    <title>New Blood Inventory Added</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body style="font-family: 'Figtree', Arial, sans-serif; margin: 0; padding: 0; background-color: #f9f9f9;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 8px;">
        <div class="mail-sender" style="text-align: center;">
            <h2 style="color: #333333; font-weight: 600;">New Blood Inventory Added</h2>
            <p style="color: #555555; font-size: 16px;">
                Dear {{ $user }},
            </p>
            <p style="color: #555555; font-size: 16px;">
                We are pleased to inform you that new blood units have been successfully added to the inventory. Please see the details below:
            </p>

            <div style="margin: 20px 0; padding: 15px; background-color: #d4edda; border-radius: 8px;">
                <p style="color: #155724; font-size: 16px;">
                    <b>Blood Type:</b> {{ $bloodType }} <br>
                    <b>Quantity:</b> {{ $quantity }} units <br>
                    <b>Added Date:</b> {{ $addedDate }} <br>
                    <b>Expiry Date:</b> {{ $expirationDate }}
                </p>
            </div>

            <p style="color: #555555; font-size: 16px;">
                Please update your records and make arrangements as needed. Thank you for your continued dedication to supporting our community with safe and timely blood donations.
            </p>
        </div>

        <div class="mail-base-regard" style="text-align: center; margin-top: 30px;">
            <p style="color: #333333; font-size: 14px;"><b>Best Regards,</b> <br>
                Blood Donation Team</p>
        </div>

        <div class="mail-center"
            style="text-align: center; margin-top: 20px; padding-top: 10px; border-top: 1px solid #dddddd;">
            <p style="color: #aaaaaa; font-size: 12px;">© {{ date('Y') }} Blood Donation. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
