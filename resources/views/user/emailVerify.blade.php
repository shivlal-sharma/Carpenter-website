<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
</head>
<body>
    <div class="container" style="font-family: Arial, sans-serif; padding: 20px; background-color: #f8f8f8; border-radius: 8px;">
        <h2>Email Verification</h2>
        <p>Dear {{$name}},</p>
        <p>Thank you for registering. Please verify your email address by clicking the link below:</p>
        <a href="{{ $url }}" style="display:inline-block; color: #fff; background-color: #4CAF50; padding: 7px 20px; text-decoration: none; border-radius: 5px;">Verify Email</a>
        <p style="color:#f00;">This link is valid for 2 minutes.</p>
        <p>If you did not create an account, no further action is required.</p>
        <hr style="margin: 20px 0;">
        <p>At Sharma Furniture, we are dedicated to providing high-quality furniture that combines style and functionality. Our collection includes a wide range of items, from elegant dining sets to cozy living room pieces, all crafted with care and attention to detail.</p>
        <p>We believe in creating spaces that reflect your personal style while ensuring comfort and durability. Our mission is to help you find the perfect pieces that make your home truly yours.</p>
        <p>For updates on our latest products, promotions, and design tips, follow us on our social media channels or subscribe to our newsletter!</p>
        <p>Your privacy is important to us. Please take a moment to review our <a href="{{ route('privacy&policy') }}" style="color: #107b00; text-decoration: underline; font-weight:bold; margin-inline:3px;">Privacy Policy</a> to understand how we collect, use, and protect your information.</p>
        <p>Thank you for choosing Sharma Furniture!</p>
        <p>Best regards,<br>The Sharma Furniture Team</p>
        <div style="margin-top: 10px; font-size: 13px; color: #aaa;">
            <p style="line-height: 1.5; color: #555;">&copy; {{ date('Y') }} Sharma Furniture. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
