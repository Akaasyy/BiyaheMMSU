<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiyaheMMSU | Portal</title>
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
            overflow-x: hidden;
            background-color: #0f172a;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(15, 23, 42, 0.4), rgba(15, 23, 42, 0.4)), 
                        url("{{ asset('mariano_marcos_state_university_mmsu_ph_cover.jpg') }}");
            background-size: cover;
            background-position: center;
            filter: blur(15px);
            z-index: -1;
            transform: scale(1.15);
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.85); 
            backdrop-filter: blur(12px);
            width: 90%;
            max-width: 480px;
            padding: 3rem 2.5rem;
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
            margin-bottom: 2rem;
        }

        .portal-header h1 {
            font-size: 1.85rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.05em;
            margin: 0;
        }

        .tab-toggle {
            background-color: rgba(241, 245, 249, 0.8);
            padding: 0.35rem;
            border-radius: 1rem;
            display: flex;
            margin-bottom: 1.5rem;
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
            transition: all 0.3s ease;
        }

        .tab-active {
            background: white;
            color: #0284c7;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .form-input {
            width: 100%;
            padding: 1rem;
            border: 1.5px solid rgba(203, 213, 225, 0.8);
            border-radius: 1rem;
            font-size: 0.95rem;
            margin-bottom: 0.8rem;
            background: rgba(255, 255, 255, 0.9);
            transition: all 0.2s ease;
            box-sizing: border-box;
        }

        .form-input:focus {
            outline: none;
            border-color: #0284c7;
            background: white;
            box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.15);
        }

        .btn-portal {
            width: 100%;
            padding: 1.2rem;
            background: linear-gradient(135deg, #0284c7, #0369a1);
            color: white;
            font-weight: 800;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-radius: 1rem;
            border: none;
            cursor: pointer;
            box-shadow: 0 15px 25px -5px rgba(2, 132, 199, 0.4);
            margin-top: 0.5rem;
        }

        /* 🆕 Google Button & Divider Styling */
        .divider {
            position: relative;
            text-align: center;
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .divider::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 1px;
            background: #e2e8f0;
            z-index: 1;
        }

        .divider-text {
            position: relative;
            background: rgba(255, 255, 255, 0.95);
            padding: 0 1rem;
            color: #94a3b8;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            z-index: 2;
        }

        .btn-google {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 1rem;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            color: #475569;
            font-weight: 700;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-google:hover {
            background-color: #f8fafc;
            border-color: #cbd5e1;
            transform: translateY(-1px);
        }

        #driver-fields {
            display: none;
            animation: slideDown 0.4s ease-out;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        select.form-input {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 1.2rem center;
            background-repeat: no-repeat;
            background-size: 1.2em;
        }
    </style>
</head>
<body>

    <div class="auth-card">
        <div class="portal-header">
            <h1>BiyaheMMSU Portal</h1>
            <p class="text-slate-500 text-xs font-semibold tracking-wide mt-2">REAL-TIME SHUTTLE ECOSYSTEM</p>
        </div>

        <div class="tab-toggle">
            <a href="{{ route('login') }}" class="tab-item">Login</a>
            <div class="tab-item tab-active">Create Account</div>
        </div>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            
            <input type="text" name="name" placeholder="Full Name" required class="form-input">

            <div class="grid grid-cols-2 gap-3">
                <select name="role" id="role-select" required class="form-input" onchange="toggleDriverFields()">
                    <option value="" disabled selected>Role</option>
                    <option value="student">Student</option>
                    <option value="driver">Driver</option>
                    <option value="admin">Admin</option>
                </select>
                
                <select name="category" required class="form-input">
                    <option value="" disabled selected>Category</option>
                    <option value="student">Student</option>
                    <option value="senior">Senior Citizen</option>
                    <option value="pwd">PWD</option>
                    <option value="regular">Regular</option>
                </select>
            </div>

            <div id="driver-fields">
                <input type="text" name="license_number" placeholder="Professional License No." class="form-input">
            </div>

            <input type="email" name="email" placeholder="Email Address" required class="form-input">
            <input type="password" name="password" placeholder="Password" required class="form-input">

            <button type="submit" class="btn-portal">
                Get Started
            </button>
        </form>

        <!-- 🆕 Google Authentication Section -->
        <div class="divider">
            <span class="divider-text">Or join with</span>
        </div>

        <a href="{{ route('google.login') }}" class="btn-google">
            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" class="h-5 w-5 mr-3" alt="Google">
            Continue with Google
        </a>

        <div class="mt-8 pt-6 border-t border-slate-200 text-center">
            <p class="text-slate-400 text-xs font-medium">
                Already part of the movement? 
                <a href="{{ route('login') }}" class="text-sky-600 font-extrabold hover:underline ml-1">Log in</a>
            </p>
        </div>
    </div>

    <script>
        function toggleDriverFields() {
            const roleSelect = document.getElementById('role-select');
            const driverFields = document.getElementById('driver-fields');
            
            if (roleSelect.value === 'driver') {
                driverFields.style.display = 'block';
            } else {
                driverFields.style.display = 'none';
            }
        }
    </script>
</body>
</html>