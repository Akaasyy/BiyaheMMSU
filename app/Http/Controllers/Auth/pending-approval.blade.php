<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Waiting for Approval | BiyaheMMSU</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center">
    <div class="bg-white p-10 rounded-[2rem] shadow-2xl text-center max-w-md">
        <h1 class="text-2xl font-bold text-slate-800 mb-4">Account Pending</h1>
        <p class="text-slate-600 mb-6">
            Thank you, **{{ Auth::user()->name }}**. Your driver account is waiting for administrative approval.
        </p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-xl font-bold">
                Return to Login
            </button>
        </form>
    </div>
</body>
</html>