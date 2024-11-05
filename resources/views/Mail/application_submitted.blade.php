<!DOCTYPE html>
<html>

<head>
    <title>Blood Donation Application Submission</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body style="font-family: 'Figtree', Arial, sans-serif; margin: 0; padding: 0; background-color: #f9f9f9;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 8px;">
        <div class="mail-sender" style="text-align: center;">
            <h2 style="color: #333333; font-weight: 600;">Hello, {{ $user }}!</h2>
            <p style="color: #555555; font-size: 16px;">
                Thank you for submitting your application to join Blood Donation as a {{ $user->role }}. We’re excited about your interest in our mission and look forward to reviewing your application.
            </p>
            <p style="color: #333333; font-size: 16px;">
                <b>What’s next?</b> Our team will carefully review your information, and you’ll hear back from us soon. We appreciate your patience during this process.
            </p>
            <br>
            <p style="color: #555555; font-size: 16px;">
                If you have any questions or need further assistance, feel free to reach out to us. Thank you for helping us create a healthier community!
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
