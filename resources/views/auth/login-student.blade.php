<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiyaheMMSU | Student Login</title>

    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            background-color: #0f172a;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: linear-gradient(rgba(15, 23, 42, 0.4), rgba(15, 23, 42, 0.4)), 
                        url("{{ asset('mariano_marcos_state_university_mmsu_ph_cover.jpg') }}");
            background-size: cover;
            background-position: center;
            filter: blur(10px);
            transform: scale(1.15);
            z-index: -1;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.85); 
            backdrop-filter: blur(12px);
            width: 90%;
            max-width: 440px;
            padding: 3.5rem 2.5rem;
            border-radius: 2rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.4);
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .portal-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .portal-header h1 {
            font-size: 1.85rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
        }

        .subtitle {
            font-size: 12px;
            color: #64748b;
            font-weight: 700;
            letter-spacing: 2px;
            margin-top: 5px;
        }

        .tab-toggle {
            background-color: rgba(241, 245, 249, 0.8);
            padding: 0.35rem;
            border-radius: 1rem;
            display: flex;
            margin-bottom: 2rem;
            border: 1px solid rgba(203, 213, 225, 0.5);
        }

        .tab-item {
            flex: 1;
            padding: 0.75rem;
            text-align: center;
            font-size: 0.9rem;
            font-weight: 700;
            border-radius: 0.75rem;
            color: #64748b;
            text-decoration: none;
        }

        .tab-active {
            background: white;
            color: #0284c7;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .form-input {
            width: 100%;
            padding: 1.1rem;
            border: 1.5px solid rgba(203, 213, 225, 0.8);
            border-radius: 1rem;
            font-size: 0.95rem;
            margin-bottom: 0.7rem;
            background: rgba(255, 255, 255, 0.9);
            transition: 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: #0284c7;
            box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.15);
        }

        .btn-portal {
            width: 100%;
            padding: 1.2rem;
            background: linear-gradient(135deg, #0284c7, #0369a1);
            color: white;
            font-weight: 800;
            border-radius: 1rem;
            border: none;
            cursor: pointer;
            margin-top: 1.2rem;
            text-transform: uppercase;
        }

        .btn-portal:hover {
            transform: translateY(-2px);
        }

        .back {
            margin-top: 18px;
            text-align: center;
            font-size: 12px;
        }

        .back a {
            color: #0284c7;
            font-weight: 800;
            text-decoration: none;
        }

        .back a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="auth-card">

    <div class="portal-header">
        <h1>🎓 Student Login</h1>
        <div class="subtitle">BIYAHEMMSU ACCESS PORTAL</div>
    </div>

    <!-- Tabs -->
    <div class="tab-toggle">
        <div class="tab-item tab-active">Login</div>
        <a href="/select-role" class="tab-item">Role</a>
    </div>

    <!-- Laravel Login Form -->
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <input type="email" name="email" placeholder="Student Email" required class="form-input">

        <input type="password" name="password" placeholder="Password" required class="form-input">

        <button type="submit" class="btn-portal">
            Log in
        </button>
    </form>

    <div class="back">
        <a href="/select-role">← Back to Role Selection</a>
    </div>

</div>

</body>
</html>