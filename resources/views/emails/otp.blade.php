<!DOCTYPE html>
<html>
<head>
    <style>
        .container { font-family: Arial, sans-serif; padding: 20px; text-align: center; }
        .otp { font-size: 32px; font-weight: bold; letter-spacing: 10px; color: #2d3748; background: #edf2f7; padding: 20px; border-radius: 10px; display: inline-block; }
        .footer { font-size: 12px; color: #a0aec0; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hospital Management System</h1>
        <p>You requested a password reset. Use the code below to proceed:</p>
        
        <div class="otp">{{ $otp }}</div>
        
        <p>This code is valid for <strong>15 minutes</strong>.</p>
        <p>If you did not request this, please ignore this email.</p>
        
        <div class="footer">
            &copy; {{ date('Y') }} Hospital System. All rights reserved.
        </div>
    </div>
</body>
</html>