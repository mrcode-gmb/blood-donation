<!DOCTYPE html>
<html>

<head>
    <title>Blood Donation Application Update</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body style="font-family: 'Figtree', Arial, sans-serif; margin: 0; padding: 0; background-color: #f9f9f9;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 8px;">
        <div class="mail-sender" style="text-align: center;">
            <h2 style="color: #333333; font-weight: 600;">Hello, {{ $user }}!</h2>
            <p style="color: #555555; font-size: 16px;">
                We appreciate your interest in joining our mission at Blood Donation. After careful review, we regret to inform you that your application has been <b style="color: #e74c3c;">not approved</b> at this time.
            </p>
            <p style="color: #333333; font-size: 16px;">
                <b>Don’t be discouraged!</b> We encourage you to stay involved with our community and look for other ways to make a difference. Together, we can continue working toward a healthier, more connected world.
            </p>
            <br>
            <p style="color: #555555; font-size: 16px;">
                Please feel free to reach out if you have any questions or need guidance on reapplying in the future.
            </p>
        </div>

        <div class="mail-base-regard" style="text-align: center; margin-top: 30px;">
            <p style="color: #333333; font-size: 14px;"><b>Warm Regards,</b> <br>
                Blood Donation Team</p>
        </div>

        <div class="mail-center"
            style="text-align: center; margin-top: 20px; padding-top: 10px; border-top: 1px solid #dddddd;">
            <p style="color: #aaaaaa; font-size: 12px;">© {{ date('Y') }} Blood Donation. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
