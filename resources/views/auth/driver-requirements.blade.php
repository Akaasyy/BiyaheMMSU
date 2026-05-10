<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiyaheMMSU | Driver Requirements</title>
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
            background: linear-gradient(rgba(15,23,42,0.5), rgba(15,23,42,0.5)),
                        url("{{ asset('mariano_marcos_state_university_mmsu_ph_cover.jpg') }}");
            background-size: cover; 
            background-position: center;
            filter: blur(10px); 
            transform: scale(1.15); 
            z-index: -1;
        }

        .card {
            background: rgba(255,255,255,0.88); 
            backdrop-filter: blur(12px);
            width: 90%; 
            max-width: 420px; 
            padding: 3rem 2.5rem;
            border-radius: 2rem; 
            box-shadow: 0 25px 50px rgba(0,0,0,0.4); 
            text-align: center;
        }

        .subtitle { 
            font-size: 11px; 
            color: #64748b; 
            letter-spacing: 2px; 
            margin-bottom: 25px; 
            text-transform: uppercase; 
            font-weight: 600;
        }

        input[type="file"] { 
            width: 100%; 
            padding: 12px; 
            margin-bottom: 5px; 
            border-radius: 12px; 
            border: 1px solid #cbd5e1; 
            background: white; 
            font-size: 14px;
            box-sizing: border-box;
        }

        label {
            display: block;
            text-align: left;
            font-size: 12px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 6px;
            margin-left: 4px;
        }

        .status-link {
            display: block;
            text-align: left;
            font-size: 11px;
            margin-bottom: 15px;
            margin-left: 6px;
            color: #059669; /* Emerald 600 */
        }

        .status-link a {
            font-weight: 700;
            text-decoration: underline;
            color: #0284c7; /* Blue 600 */
        }

        .btn-primary { 
            width: 100%; 
            padding: 14px; 
            border-radius: 12px; 
            background: linear-gradient(135deg,#0284c7,#0369a1); 
            color: white; 
            font-weight: 800; 
            cursor: pointer; 
            border: none;
            transition: opacity 0.2s; 
            margin-top: 10px;
        }

        .btn-primary:hover { 
            opacity: 0.9; 
        }

        .btn-logout { 
            display: block; 
            margin-top: 25px; 
            font-size: 12px; 
            color: #ef4444; 
            font-weight: 700; 
            text-transform: uppercase;
            letter-spacing: 1px;
            background: none;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        .error-box {
            background: #fef2f2;
            border: 1px solid #fee2e2;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 20px;
            color: #b91c1c;
            font-size: 12px;
            text-align: left;
        }
    </style>
</head>

<body>

<div class="card">
    <h1>🚗 Verification</h1>
    <div class="subtitle">Driver Requirements</div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="error-box">
            <ul class="list-none">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Main Requirement Form --}}
    <form method="POST" action="{{ route('driver.upload.submit') }}" enctype="multipart/form-data">
        @csrf 
        
        <div>
            <label>Driver's License (Front)</label>
            <input type="file" name="license">
            
            @if(Auth::user()->license_path)
                <div class="status-link">
                    ✅ Current File: <a href="{{ asset('storage/' . Auth::user()->license_path) }}" target="_blank">license.jpg</a>
                </div>
            @else
                <div class="status-link" style="color: #64748b; font-style: italic;">No file uploaded yet</div>
            @endif
        </div>

        <div>
            <label>Vehicle Registration (OR/CR)</label>
            <input type="file" name="orcr">
            
            @if(Auth::user()->orcr_path)
                <div class="status-link">
                    ✅ Current File: <a href="{{ asset('storage/' . Auth::user()->orcr_path) }}" target="_blank">orcr.jpg</a>
                </div>
            @else
                <div class="status-link" style="color: #64748b; font-style: italic;">No file uploaded yet</div>
            @endif
        </div>

        <button type="submit" class="btn-primary">Update Requirements</button>
    </form>

    {{-- Sign Out Action --}}
    <div style="margin-top: 20px; border-top: 1px solid #e2e8f0; padding-top: 10px;">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                Cancel & Sign Out
            </button>
        </form>
    </div>
</div>

</body>
</html>