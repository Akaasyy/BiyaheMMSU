<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiyaheMMSU | Admin Login</title>

    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0f172a;
            overflow: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: linear-gradient(rgba(15,23,42,0.6), rgba(15,23,42,0.6)),
                        url("{{ asset('mariano_marcos_state_university_mmsu_ph_cover.jpg') }}");
            background-size: cover;
            background-position: center;
            filter: blur(10px);
            transform: scale(1.15);
            z-index: -1;
        }

        .card {
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(12px);
            width: 90%;
            max-width: 420px;
            padding: 3rem 2.5rem;
            border-radius: 2rem;
            box-shadow: 0 25px 50px rgba(0,0,0,0.45);
            text-align: center;
            animation: fadeIn 0.7s ease;
        }

        @keyframes fadeIn {
            from {opacity:0; transform:translateY(20px);}
            to {opacity:1; transform:translateY(0);}
        }

        h1 {
            font-weight: 800;
            margin-bottom: 5px;
            color: #0f172a;
        }

        .subtitle {
            font-size: 12px;
            color: #64748b;
            letter-spacing: 2px;
            margin-bottom: 25px;
            font-weight: 700;
        }

        input {
            width: 100%;
            padding: 14px;
            margin-bottom: 12px;
            border-radius: 12px;
            border: 1px solid #cbd5e1;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #0284c7;
            box-shadow: 0 0 0 3px rgba(2,132,199,0.2);
        }

        button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg,#0284c7,#0369a1);
            color: white;
            font-weight: 800;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            transform: translateY(-2px);
            filter: brightness(1.1);
        }

        .error {
            color: #ef4444;
            font-size: 12px;
            margin-bottom: 12px;
            font-weight: 700;
        }

        .back {
            margin-top: 14px;
            font-size: 12px;
        }

        .back a {
            color: #0284c7;
            font-weight: 700;
            text-decoration: none;
        }

        .back a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="card">

    <h1>👨‍💼 Admin Login</h1>
    <div class="subtitle">BIYAHEMMSU CONTROL PANEL</div>

    {{-- ERROR MESSAGE --}}
    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf

        <input type="email" name="email" placeholder="Admin Email" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Login</button>
    </form>

    <div class="back">
        <a href="/admin/verify">← Back to Verification</a>
    </div>

</div>

</body>
</html>