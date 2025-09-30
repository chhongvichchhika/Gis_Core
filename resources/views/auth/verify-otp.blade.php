<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 48px 40px;
            width: 100%;
            max-width: 440px;
        }

        .header {
            text-align: center;
            margin-bottom: 32px;
        }

        .icon-wrapper {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .icon-wrapper svg {
            width: 32px;
            height: 32px;
            stroke: white;
        }

        h2 {
            color: #1a202c;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #718096;
            font-size: 14px;
            line-height: 1.5;
        }

        .error-list {
            background: #fff5f5;
            border: 1px solid #fc8181;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 24px;
        }

        .error-list ul {
            list-style: none;
        }

        .error-list li {
            color: #c53030;
            font-size: 14px;
            padding: 4px 0;
            display: flex;
            align-items: center;
        }

        .error-list li:before {
            content: "⚠";
            margin-right: 8px;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        label {
            display: block;
            color: #2d3748;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        input[type="text"] {
            width: 100%;
            padding: 14px 16px;
            font-size: 18px;
            letter-spacing: 8px;
            text-align: center;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        input[type="text"]::placeholder {
            letter-spacing: normal;
        }

        button[type="submit"] {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
        }

        button[type="submit"]:active {
            transform: translateY(0);
        }

        .resend-link {
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
            color: #718096;
        }

        .resend-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .resend-link a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .container {
                padding: 32px 24px;
            }

            h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="icon-wrapper">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h2>Verify Your Account</h2>
            <p class="subtitle">Enter the 6-digit code sent to your device</p>
        </div>

        @if ($errors->any())
            <div class="error-list">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('otp.verify') }}">
            @csrf
            <div class="form-group">
                <label for="otp">Verification Code</label>
                <input 
                    type="text" 
                    id="otp" 
                    name="otp" 
                    maxlength="6" 
                    placeholder=" "
                    pattern="[0-9]{6}"
                    inputmode="numeric"
                    required 
                    autofocus
                >
            </div>
            <button type="submit">Verify Code</button>
        </form>

     <div class="resend-link">
        Didn't receive the code? <a href="#" id="resend-otp">Resend</a>
    </div>


@if(session('success'))
    <div class="success-message" style="color: green; text-align:center; margin-top:10px;">
        {{ session('success') }}
    </div>
@endif

    </div>
</body>
<script>
document.getElementById('resend-otp').addEventListener('click', function(e) {
    e.preventDefault();

    fetch("{{ route('otp.resend') }}")
        .then(res => res.json())
        .then(data => {
            alert(data.message); // optional: show success message
            if(data.success && data.redirect){
                // redirect the user to OTP screen
                window.location.href = data.redirect;
            }
        })
        .catch(err => {
            alert('Something went wrong. Please try again.');
        });
});
</script>

</html>