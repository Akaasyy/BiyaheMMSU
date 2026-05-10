<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiyaheMMSU | Laoag → Paoay Shuttle Tracker</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #0B0E14; color: white; }
        .btn-orange { background: linear-gradient(135deg, #FF8A3D 0%, #FF512F 100%); transition: 0.3s; }
        .btn-orange:hover { transform: translateY(-2px); opacity: 0.9; }
        .glass-card { background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); backdrop-filter: blur(12px); }
        .glow { position: absolute; width: 500px; height: 500px; background: radial-gradient(circle, rgba(255,138,61,0.07) 0%, rgba(0,0,0,0) 70%); z-index: 0; }
    </style>
</head>
<body class="antialiased overflow-x-hidden">

    <header class="relative min-h-screen px-6 lg:px-24 pt-8">
        <div class="glow -top-20 -left-20"></div>
        <div class="glow top-1/2 -right-20"></div>

        <nav class="relative z-10 flex justify-between items-center mb-16">
            <div class="flex items-center gap-3">
                <div class="bg-orange-500 p-2 rounded-xl text-white"><i class="fas fa-bus-alt text-xl"></i></div>
                <div class="leading-none">
                    <h2 class="font-extrabold text-xl tracking-tight uppercase">BiyaheMMSU</h2>
                    <p class="text-[8px] tracking-[0.2em] text-gray-500 font-bold">LAOAG → PAOAY</p>
                </div>
            </div>
        </nav>

        <div class="relative z-10 grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="inline-flex items-center gap-2 bg-white/5 border border-white/10 px-3 py-1 rounded-full text-[11px] font-bold mb-8">
                    <span class="h-2 w-2 bg-green-500 rounded-full animate-pulse"></span> 4 SHUTTLES LIVE NOW
                </div>
                <h1 class="text-6xl lg:text-8xl font-extrabold leading-[1.05] mb-6">
                    Never miss the <br>
                    <span class="text-orange-500 italic">Laoag → Paoay</span> <br>
                    shuttle again.
                </h1>
                <p class="text-gray-400 text-lg mb-10 max-w-lg leading-relaxed">
                    Real-time tracking, accurate ETAs, and seat availability for the MMSU student shuttle. Built by Ilocanos, for Ilocanos.
                </p>
                
                <div class="mt-20 grid grid-cols-3 gap-12 border-t border-white/10 pt-10">
                    <div><p class="text-4xl font-bold">12k+</p><p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-1">MMSU Students</p></div>
                    <div><p class="text-4xl font-bold">38 km</p><p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-1">Route Distance</p></div>
                    <div><p class="text-4xl font-bold text-orange-500">< 2 min</p><p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-1">ETA Accuracy</p></div>
                </div>
            </div>

            <div class="relative">
                <div class="glass-card p-4 rounded-[2.5rem] shadow-2xl overflow-hidden">
                    <div class="relative rounded-[2rem] overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?auto=format&fit=crop&q=80" class="w-full h-[500px] object-cover opacity-60">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0B0E14] via-transparent to-transparent"></div>
                        
                        <div class="absolute top-8 left-8 bg-white rounded-2xl p-5 flex items-center gap-5 text-black shadow-2xl">
                            <div class="bg-green-100 text-green-600 p-3 rounded-2xl"><i class="fas fa-bus text-xl"></i></div>
                            <div>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">Shuttle 02</p>
                                <p class="text-2xl font-black leading-none">7 min</p>
                            </div>
                        </div>

                        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 w-[80%]">
                            <div class="bg-white/10 backdrop-blur-md border border-white/20 py-3 px-6 rounded-full flex items-center justify-center gap-3">
                                <i class="fas fa-map-marker-alt text-orange-500"></i>
                                <span class="text-sm font-bold">Approaching MMSU Main Gate</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="bg-white text-black py-32 px-6 lg:px-24">
        <div class="text-center mb-20">
            <p class="text-orange-500 font-bold text-xs uppercase tracking-[0.3em] mb-4">Why BiyaheMMSU</p>
            <h2 class="text-5xl lg:text-6xl font-black tracking-tight leading-none">Built around the way <br>students actually commute.</h2>
        </div>
        <div class="grid md:grid-cols-2 gap-6">
            @php
                $features = [
                    ['icon' => 'fa-location-arrow', 'title' => 'Live GPS Tracking', 'desc' => 'Watch your shuttle move in real-time across the Laoag-Paoay route.'],
                    ['icon' => 'fa-clock', 'title' => 'Smart ETAs', 'desc' => 'Predicted arrivals adjust to traffic on MacArthur Highway and weather.'],
                    ['icon' => 'fa-shield-alt', 'title' => 'Verified Drivers', 'desc' => 'Every shuttle and driver is registered with the MMSU Office of Student Affairs.'],
                    ['icon' => 'fa-bolt', 'title' => 'Free for Students', 'desc' => 'Just sign in with your @mmsu.edu.ph email. No ads, no fees.']
                ];
            @endphp
            @foreach($features as $f)
            <div class="p-10 rounded-[2.5rem] border border-gray-100 bg-gray-50/50 group hover:bg-white hover:shadow-2xl hover:shadow-gray-200 transition-all duration-500">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center bg-white shadow-sm mb-8 group-hover:bg-orange-500 group-hover:text-white transition-colors">
                    <i class="fas {{ $f['icon'] }} text-xl"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">{{ $f['title'] }}</h3>
                <p class="text-gray-500 leading-relaxed">{{ $f['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <section class="bg-[#FDF8F4] text-black py-32 px-6 lg:px-24 flex flex-col lg:flex-row items-center gap-20">
        <div class="lg:w-1/2">
            <p class="text-orange-500 font-bold text-xs uppercase tracking-widest mb-4 font-bold">THE ROUTE</p>
            <h2 class="text-6xl font-black mb-10 leading-[1.1]">Five stops. One <br>legendary commute.</h2>
            <div class="flex flex-wrap gap-4 mb-10">
                <span class="bg-white px-5 py-3 rounded-2xl shadow-sm text-sm font-bold flex items-center gap-2"><i class="far fa-clock text-orange-500"></i> 5:30 AM — 9:30 PM</span>
                <span class="bg-white px-5 py-3 rounded-2xl shadow-sm text-sm font-bold flex items-center gap-2"><i class="far fa-calendar text-orange-500"></i> Mon — Sat</span>
                <span class="bg-white px-5 py-3 rounded-2xl shadow-sm text-sm font-bold flex items-center gap-2"><i class="fas fa-bus text-orange-500"></i> Every 20 min</span>
            </div>
            <p class="text-gray-500 max-w-md">Shuttles run consistently between terminals. Special schedules during finals week and university holidays.</p>
        </div>
        <div class="lg:w-1/2 w-full">
            <div class="bg-white p-10 rounded-[3rem] shadow-2xl relative">
                <div class="absolute top-8 right-8 bg-green-100 text-green-600 px-3 py-1 rounded-full text-[10px] font-bold uppercase">On time</div>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">MORNING RUN</p>
                <h3 class="text-2xl font-black mb-10">Laoag → Paoay</h3>
                
                <div class="space-y-8 relative">
                    <div class="absolute left-[7px] top-2 bottom-2 w-0.5 bg-gray-100"></div>
                    @php
                        $stops = [
                            ['name' => 'Laoag Terminal', 'time' => '06:00', 'active' => true],
                            ['name' => 'Aurora Park', 'time' => '06:08', 'active' => true],
                            ['name' => 'MMSU Main Gate', 'time' => '06:22', 'active' => true],
                            ['name' => 'Batac Junction', 'time' => '06:38', 'active' => true],
                            ['name' => 'Paoay Church', 'time' => '06:55', 'active' => false]
                        ];
                    @endphp
                    @foreach($stops as $stop)
                    <div class="flex justify-between items-center relative z-10">
                        <div class="flex items-center gap-6">
                            <div class="w-4 h-4 rounded-full border-4 {{ $stop['active'] ? 'bg-orange-500 border-orange-100 shadow-[0_0_0_4px_rgba(255,138,61,0.1)]' : 'bg-gray-800 border-gray-100' }}"></div>
                            <p class="font-extrabold {{ $stop['active'] ? 'text-black' : 'text-gray-400' }}">{{ $stop['name'] }}</p>
                        </div>
                        <span class="text-xs font-bold font-mono {{ $stop['active'] ? 'text-gray-900' : 'text-gray-400' }}">{{ $stop['time'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-24 px-6">
        <div class="max-w-6xl mx-auto bg-[#0B0E14] rounded-[3.5rem] p-16 lg:p-24 text-center relative overflow-hidden">
            <div class="glow top-0 right-0"></div>
            <h2 class="text-5xl lg:text-6xl font-black mb-8 relative z-10">Ready to skip the wait?</h2>
            <p class="text-gray-400 text-lg mb-12 relative z-10 max-w-xl mx-auto">Sign in with your MMSU email and start tracking shuttles in less than 30 seconds.</p>
            <div class="flex justify-center relative z-10">
                <a href="{{ route('role.selection') }}" class="btn-orange px-12 py-5 rounded-2xl font-bold flex items-center gap-4 text-white shadow-2xl">
                    Select Role <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <footer class="bg-white py-12 px-6 lg:px-24 flex flex-col md:flex-row justify-between items-center border-t border-gray-50">
        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">© 2026 BiyaheMMSU • Mariano Marcos State University</p>
        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-4 md:mt-0">Made with <i class="fas fa-heart text-red-500 mx-1"></i> in Ilocos Norte</p>
    </footer>

</body>
</html>