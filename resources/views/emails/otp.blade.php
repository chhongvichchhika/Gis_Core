<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fa;
        }
        
        .email-wrapper {
            width: 100%;
            background-color: #f4f7fa;
            padding: 40px 0;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 30px;
            text-align: center;
        }
        
        .email-header h1 {
            margin: 0;
            color: #ffffff;
            font-size: 28px;
            font-weight: 600;
        }
        
        .lock-icon {
            width: 60px;
            height: 60px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .lock-icon svg {
            width: 30px;
            height: 30px;
            stroke: white;
        }
        
        .email-body {
            padding: 40px 30px;
        }
        
        .greeting {
            color: #2d3748;
            font-size: 20px;
            font-weight: 600;
            margin: 0 0 16px 0;
        }
        
        .message {
            color: #4a5568;
            font-size: 16px;
            line-height: 1.6;
            margin: 0 0 32px 0;
        }
        
        .otp-container {
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
            border: 2px dashed #cbd5e0;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            margin: 32px 0;
        }
        
        .otp-label {
            color: #718096;
            font-size: 14px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }
        
        .otp-code {
            font-size: 48px;
            font-weight: 700;
            color: #667eea;
            letter-spacing: 12px;
            margin: 0;
            font-family: 'Courier New', monospace;
        }
        
        .expiry-notice {
            background-color: #fff5f5;
            border-left: 4px solid #fc8181;
            padding: 16px 20px;
            border-radius: 4px;
            margin: 24px 0;
        }
        
        .expiry-notice p {
            margin: 0;
            color: #742a2a;
            font-size: 14px;
            display: flex;
            align-items: center;
        }
        
        .expiry-notice .icon {
            margin-right: 8px;
            font-size: 18px;
        }
        
        .security-info {
            background-color: #f7fafc;
            border-radius: 8px;
            padding: 20px;
            margin-top: 32px;
        }
        
        .security-info h3 {
            color: #2d3748;
            font-size: 16px;
            margin: 0 0 12px 0;
            font-weight: 600;
        }
        
        .security-info p {
            color: #4a5568;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }
        
        .email-footer {
            background-color: #2d3748;
            padding: 30px;
            text-align: center;
        }
        
        .email-footer p {
            color: #a0aec0;
            font-size: 13px;
            margin: 8px 0;
            line-height: 1.5;
        }
        
        .email-footer .company-name {
            color: #ffffff;
            font-weight: 600;
        }
        
        @media only screen and (max-width: 600px) {
            .email-wrapper {
                padding: 20px 0;
            }
            
            .email-header {
                padding: 30px 20px;
            }
            
            .email-body {
                padding: 30px 20px;
            }
            
            .otp-code {
                font-size: 36px;
                letter-spacing: 8px;
            }
            
            .email-footer {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-container">
            <div class="email-header">
                <div class="lock-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h1>Verification Code</h1>
            </div>
            
            <div class="email-body">
                <h2 class="greeting">Hello,</h2>
                <p class="message">
                    We received a request to verify your account. Please use the following One-Time Password (OTP) to complete your verification:
                </p>
                
                <div class="otp-container">
                    <div class="otp-label">Your Verification Code</div>
                    <h1 class="otp-code">{{ $otp }}</h1>
                </div>
                
                <div class="expiry-notice">
                    <p>
                        <span class="icon">⏱️</span>
                        <strong>Important:</strong> This code will expire in 5 minutes for security purposes.
                    </p>
                </div>
                
                <div class="security-info">
                    <h3>🔒 Security Tips</h3>
                    <p>
                        Never share this code with anyone. Our team will never ask you for this code. 
                        If you didn't request this verification, please ignore this email or contact our support team immediately.
                    </p>
                </div>
            </div>
            
            <div class="email-footer">
                <p class="company-name">Your Company Name</p>
                <p>This is an automated message, please do not reply to this email.</p>
                <p>&copy; 2025 All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>