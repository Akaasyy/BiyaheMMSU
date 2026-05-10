<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiyaheMMSU | Driver Login</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0; min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            background: #0f172a; overflow: hidden;
        }
        body::before {
            content: ""; position: fixed; inset: 0;
            background: linear-gradient(rgba(15,23,42,0.5), rgba(15,23,42,0.5)),
                        url("{{ asset('mariano_marcos_state_university_mmsu_ph_cover.jpg') }}");
            background-size: cover; background-position: center;
            filter: blur(10px); transform: scale(1.15); z-index: -1;
        }
        .card {
            background: rgba(255,255,255,0.88); backdrop-filter: blur(12px);
            width: 90%; max-width: 420px; padding: 3rem 2.5rem;
            border-radius: 2rem; box-shadow: 0 25px 50px rgba(0,0,0,0.4); text-align: center;
        }
        .subtitle { font-size: 11px; color: #64748b; letter-spacing: 2px; margin-bottom: 25px; text-transform: uppercase; font-weight: 700; }
        
        /* Updated Google Button Styling for Primary Action */
        .btn-google { 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            width: 100%; 
            padding: 16px; 
            background: white; 
            border: 1px solid #cbd5e1; 
            border-radius: 12px; 
            color: #0f172a; 
            font-weight: 700; 
            text-decoration: none; 
            cursor: pointer; 
            transition: all 0.2s;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .btn-google:hover { 
            background-color: #f8fafc; 
            border-color: #0284c7; 
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .helper-text {
            margin-top: 15px;
            font-size: 13px;
            color: #64748b;
            line-height: 1.5;
        }

        .error-alert { background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 10px; margin-bottom: 15px; font-size: 13px; text-align: left; border: 1px solid #fecaca; }
    </style>
</head>

<body>

<div class="card">
    <h1>🚌 Driver Portal</h1>
    <div class="subtitle">BiyaheMMSU Transport</div>

    @if ($errors->any())
        <div class="error-alert">
            @foreach ($errors->all() as $error)
                <p>• {{ $error }}</p>
            @endforeach
        </div>
    @endif

    {{-- 
        DESIGN DECISION: 
        We use a single Google OAuth entry point. 
        This handles both "New Registration" and "Returning Login" seamlessly.
    --}}
    <a href="{{ route('google.login') }}" class="btn-google">
        <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" style="width:20px; margin-right:12px;" alt="G">
        Continue with Google Account
    </a>

    <p class="helper-text">
        Please use your <strong>MMSU Google Account</strong> to access the driver dashboard and tracking features.
    </p>

    <a href="{{ route('role.selection') }}" style="display:block; margin-top:30px; font-size:12px; color:#64748b; font-weight:600; text-decoration: none; border-top: 1px solid #e2e8f0; pt-20">
        <br>← Back to Role Selection
    </a>
</div>

</body> 
</html>