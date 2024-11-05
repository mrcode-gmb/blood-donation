<!DOCTYPE html>
<html>

<head>
    <title>Blood Donation Application Notification</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body style="font-family: 'Figtree', Arial, sans-serif; margin: 0; padding: 0; background-color: #f9f9f9;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 8px;">
        <div class="mail-sender" style="text-align: center;">
            <h2 style="color: #333333; font-weight: 600;">Hello, {{ $user }}!</h2>
            <p style="color: #555555; font-size: 16px;">We’re thrilled to inform you that your application for Blood Donation has been <b
                    style="color: green;">Approved</b>.</p>
            <p style="color: #333333; font-size: 16px;"><b>Thank you for joining our mission to save lives!</b></p>
            <br>
            <p style="color: #555555; font-size: 16px;">
                Whether as a donor or a partnering hospital, your contribution helps us ensure blood is available for those in need. We look forward to working with you!
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
