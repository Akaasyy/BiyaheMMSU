<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Verification | BiyaheMMSU</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
body {
    margin: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: #0f172a;
    position: relative;
    overflow: hidden;
}

/* SAME BACKGROUND STYLE */
body::before {
    content: "";
    position: fixed;
    inset: 0;
    background: linear-gradient(rgba(15,23,42,0.55), rgba(15,23,42,0.55)),
    url("/mariano_marcos_state_university_mmsu_ph_cover.jpg");
    background-size: cover;
    background-position: center;
    filter: blur(12px);
    transform: scale(1.1);
    z-index: -1;
}

/* GLASS CARD */
.box {
    background: rgba(255,255,255,0.88);
    backdrop-filter: blur(14px);
    padding: 2.5rem;
    border-radius: 2rem;
    text-align: center;
    width: 90%;
    max-width: 380px;
    box-shadow: 0 25px 50px rgba(0,0,0,0.4);
    animation: fadeIn 0.6s ease;
}

@keyframes fadeIn {
    from {opacity: 0; transform: translateY(20px);}
    to {opacity: 1; transform: translateY(0);}
}

h2 {
    font-size: 1.4rem;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 5px;
}

p {
    font-size: 12px;
    color: #64748b;
    margin-bottom: 1.5rem;
    font-weight: 600;
}

/* INPUT */
input {
    width: 100%;
    padding: 12px;
    border-radius: 12px;
    border: 1px solid #cbd5e1;
    outline: none;
    font-size: 14px;
    transition: 0.2s;
}

input:focus {
    border-color: #0284c7;
    box-shadow: 0 0 0 3px rgba(2,132,199,0.2);
}

/* BUTTON */
button {
    margin-top: 12px;
    padding: 12px;
    width: 100%;
    background: linear-gradient(135deg, #0284c7, #0369a1);
    color: white;
    border: none;
    border-radius: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: 0.25s;
    box-shadow: 0 10px 20px rgba(2,132,199,0.3);
}

button:hover {
    transform: translateY(-2px);
    filter: brightness(1.1);
}

/* ERROR */
.error {
    color: #ef4444;
    font-size: 12px;
    margin-bottom: 10px;
    font-weight: 600;
}
</style>
</head>

<body>

<div class="box">
    <h2>Admin Access</h2>
    <p>Enter verification code to continue</p>

    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.verify.submit') }}">
        @csrf

        <input type="password" name="code" placeholder="Enter Access Code" required>

        <button type="submit">Continue</button>
    </form>
</div>

</body>
</html>