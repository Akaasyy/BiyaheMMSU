<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Pending | BiyaheMMSU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-2xl w-full bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-slate-100">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-10 text-center text-white">
            <div class="inline-block p-3 bg-white/20 rounded-full mb-4">
                <span class="text-3xl">🚍</span>
            </div>
            <h1 class="text-3xl font-extrabold tracking-tight">Welcome, {{ Auth::user()->name }}!</h1>
            <p class="mt-2 text-blue-100 opacity-90">Your registration for the Laoag-Paoay route is being processed.</p>
        </div>

        <div class="p-8 md:p-12">
            <div class="mb-12">
                <h2 class="text-sm font-bold uppercase tracking-widest text-slate-400 mb-6 flex items-center">
                    Verification Progress
                </h2>
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div class="flex items-center text-green-600 font-semibold bg-green-50 pr-4 py-2 rounded-full border border-green-100">
                        <div class="rounded-full bg-green-500 text-white w-7 h-7 flex items-center justify-center mr-3 shadow-md">✓</div> 
                        Google Linked
                    </div>
                    
                    <div class="hidden md:block h-px bg-slate-200 flex-grow mx-2"></div>
                    
                    <div class="flex items-center text-blue-600 font-bold px-4 py-2 rounded-full border border-blue-200 bg-blue-50 animate-pulse">
                        <div class="rounded-full bg-blue-600 text-white w-7 h-7 flex items-center justify-center mr-3 shadow-lg ring-4 ring-blue-100">2</div> 
                        Admin Review
                    </div>
                    
                    <div class="hidden md:block h-px bg-slate-200 flex-grow mx-2"></div>
                    
                    <div class="flex items-center text-slate-400 font-medium px-4 py-2">
                        <div class="rounded-full bg-slate-100 text-slate-400 w-7 h-7 flex items-center justify-center mr-3 border border-slate-200">3</div> 
                        Ready to Drive
                    </div>
                </div>
            </div>

            <div class="mb-10 bg-slate-50 rounded-3xl p-8 border border-slate-100">
                <h2 class="text-lg font-bold text-slate-800 mb-4">Required Documents</h2>
                <p class="text-sm text-slate-500 mb-6">Please prepare these documents for submission at the MMSU Transport Office:</p>
                
                <ul class="space-y-4">
                    <li class="flex items-center text-slate-700 bg-white p-3 rounded-xl border border-slate-200 shadow-sm">
                        <div class="w-5 h-5 mr-3 border-2 border-blue-400 rounded-md"></div>
                        Professional Driver’s License
                    </li>
                    <li class="flex items-center text-slate-700 bg-white p-3 rounded-xl border border-slate-200 shadow-sm">
                        <div class="w-5 h-5 mr-3 border-2 border-blue-400 rounded-md"></div>
                        Vehicle Registration (OR/CR)
                    </li>
                    <li class="flex items-center text-slate-700 bg-white p-3 rounded-xl border border-slate-200 shadow-sm">
                        <div class="w-5 h-5 mr-3 border-2 border-blue-400 rounded-md"></div>
                        Proof of MMSU Employment / Terminal ID
                    </li>
                </ul>
            </div>

            @if(Auth::user()->admin_comment)
                <div class="mb-10 bg-amber-50 border-2 border-amber-200 rounded-3xl p-8 relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 text-6xl opacity-10 rotate-12">💬</div>
                    
                    <h2 class="text-sm font-bold uppercase tracking-widest text-amber-600 mb-3 flex items-center">
                        <span class="mr-2">📢</span> Message from Admin
                    </h2>
                    
                    <div class="text-slate-800 italic font-semibold text-lg leading-relaxed bg-white/50 p-4 rounded-2xl border border-amber-100">
                        "{{ Auth::user()->admin_comment }}"
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('driver.upload-requirements') }}" 
                           class="flex items-center justify-center w-full py-4 bg-amber-600 hover:bg-amber-700 text-white font-bold rounded-2xl transition duration-200 shadow-lg shadow-amber-200 transform active:scale-95">
                            <span class="mr-2">📤</span> Re-upload Requirements
                        </a>
                    </div>
                    
                    <p class="text-xs text-amber-700 mt-4">
                        <strong>Note:</strong> Please address this feedback to proceed with your verification.
                    </p>
                </div>
            @endif

            <div class="space-y-6">
                <div class="bg-amber-50 border-l-4 border-amber-400 p-4 rounded-r-xl">
                    <p class="text-sm text-amber-800 font-semibold">Waiting more than 48 hours?</p>
                    <p class="text-xs text-amber-700 mt-1">Contact IT Support: <span class="font-bold underline">support.transport@mmsu.edu.ph</span></p>
                </div>

                <div class="flex flex-col md:flex-row gap-4">
                    <button onclick="window.location.reload();" class="flex-1 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl transition duration-200 shadow-lg shadow-blue-200 transform active:scale-95 flex items-center justify-center">
                        <span class="mr-2">🔄</span> Refresh My Status
                    </button>
                    
                    <form method="POST" action="{{ route('logout') }}" class="flex-none">
                        @csrf
                        <button type="submit" class="w-full md:w-auto px-8 py-4 bg-white border-2 border-slate-200 text-slate-600 font-bold rounded-2xl hover:bg-slate-50 transition duration-200">
                            Logout
                        </button>
                    </form>
                </div>
                
                <p class="text-center text-xs text-slate-400 mt-6">
                    Logged in as: <span class="font-semibold">{{ Auth::user()->email }}</span>
                </p>
            </div>
        </div>

        <div class="bg-slate-50 py-4 text-center text-[10px] text-slate-400 uppercase tracking-widest border-t border-slate-100">
            BiyaheMMSU Official Driver Portal &copy; 2026
        </div>
    </div>

</body>
</html>