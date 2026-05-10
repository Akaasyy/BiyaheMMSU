<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Role | BiyaheMMSU</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { margin: 0; height: 100vh; display: flex; justify-content: center; align-items: center; font-family: 'Plus Jakarta Sans', sans-serif; position: relative; overflow: hidden; background: #0f172a; }
        body::before { 
            content: ""; position: fixed; top: 0; left: 0; width: 100%; height: 100%; 
            background: linear-gradient(rgba(15, 23, 42, 0.6), rgba(15, 23, 42, 0.6)), 
                        url("{{ asset('mariano_marcos_state_university_mmsu_ph_cover.jpg') }}"); 
            background-size: cover; background-position: center; 
            filter: blur(12px); transform: scale(1.1); z-index: -1; 
        }
        .box { background: rgba(255, 255, 255, 0.88); backdrop-filter: blur(12px); padding: 3rem 2.5rem; border-radius: 2rem; text-align: center; width: 90%; max-width: 420px; box-shadow: 0 25px 50px rgba(0,0,0,0.4); animation: fadeIn 0.7s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        h2 { margin-bottom: 0.5rem; font-size: 1.6rem; font-weight: 800; color: #0f172a; }
        .subtitle { font-size: 12px; color: #64748b; margin-bottom: 1.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
        
        .role-link { 
            display: block; margin: 12px auto; padding: 15px; width: 100%; box-sizing: border-box;
            color: white; text-decoration: none; border-radius: 14px; font-weight: 700; 
            letter-spacing: 0.5px; transition: all 0.25s ease; 
        }
        
        /* Fixed: Student button color matches your design but link is now correct */
        .student { background: linear-gradient(135deg, #0284c7, #0369a1); box-shadow: 0 10px 20px rgba(2,132,199,0.3); }
        .driver { background: linear-gradient(135deg, #059669, #047857); box-shadow: 0 10px 20px rgba(5,150,105,0.3); }
        .admin { background: linear-gradient(135deg, #ef4444, #b91c1c); box-shadow: 0 10px 20px rgba(239,68,68,0.3); }
        
        .role-link:hover { transform: translateY(-3px); filter: brightness(1.1); }
    </style>
</head>
<body>
<div class="box">
    <h2>Select Your Role</h2>
    <div class="subtitle">Choose your portal to continue</div>

    <a href="{{ route('student.dashboard') }}" class="role-link student">🎓 Student</a>

    <a href="{{ route('login') }}" class="role-link driver">🚌 Driver</a>

    <a href="{{ route('admin.verify') }}" class="role-link admin">🔐 Admin</a>
</div>
</body>
</html>