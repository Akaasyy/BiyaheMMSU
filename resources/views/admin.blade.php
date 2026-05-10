<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | BiyaheMMSU</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Plus Jakarta Sans', sans-serif;
            background:#0b1220;
            color:white;
            min-height:100vh;
        }

        .main{
            width:100%;
            padding:40px;
        }

        .header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:35px;
            flex-wrap:wrap;
            gap:20px;
        }

        .title{
            font-size:32px;
            font-weight:800;
        }

        .top-actions{
            display:flex;
            align-items:center;
            gap:15px;
        }

        .status-online{
            background:#16a34a;
            padding:10px 18px;
            border-radius:999px;
            font-size:13px;
            font-weight:700;
        }

        .logout-btn{
            padding:12px 18px;
            border:none;
            border-radius:12px;
            background:#dc2626;
            color:white;
            cursor:pointer;
            font-weight:700;
        }

        .alert{
            padding:16px 18px;
            border-radius:14px;
            margin-bottom:25px;
            font-weight:600;
        }

        .alert-success{
            background:rgba(22,163,74,0.15);
            border:1px solid #16a34a;
            color:#4ade80;
        }

        /* STATS */
        .stats-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
            gap:20px;
            margin-bottom:35px;
        }

        .stat-card{
            background:#111827;
            border-radius:20px;
            padding:24px;
            border:1px solid rgba(255,255,255,0.05);
            box-shadow:0 10px 25px rgba(0,0,0,0.25);
        }

        .stat-title{
            font-size:13px;
            color:#94a3b8;
            margin-bottom:10px;
            text-transform:uppercase;
            font-weight:700;
            letter-spacing:1px;
        }

        .stat-number{
            font-size:34px;
            font-weight:800;
        }

        .approved-color{
            color:#4ade80;
        }

        .pending-color{
            color:#60a5fa;
        }

        .total-color{
            color:#facc15;
        }

        /* DRIVER GRID */
        .driver-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(380px,1fr));
            gap:25px;
        }

        .driver-card{
            background:#111827;
            border-radius:24px;
            overflow:hidden;
            border:1px solid rgba(255,255,255,0.05);
            transition:0.3s ease;
            box-shadow:0 10px 30px rgba(0,0,0,0.35);
        }

        .driver-card:hover{
            transform:translateY(-5px);
        }

        /* IMAGES */
        .driver-image-container{
            display:grid;
            grid-template-columns:1fr 1fr;
            height:240px;
            background:#1e293b;
            gap:1px;
        }

        .img-slot{
            position:relative;
            width:100%;
            height:100%;
            overflow:hidden;
            background:#1e293b;
        }

        .driver-image{
            width:100%;
            height:100%;
            object-fit:cover;
            transition:0.4s ease;
        }

        .img-slot:hover .driver-image{
            transform:scale(1.05);
        }

        .img-tag{
            position:absolute;
            top:12px;
            left:12px;
            background:rgba(15,23,42,0.9);
            padding:5px 10px;
            border-radius:8px;
            font-size:10px;
            font-weight:800;
            color:#38bdf8;
            z-index:10;
            text-transform:uppercase;
        }

        .image-error{
            height:100%;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            color:#64748b;
            font-size:13px;
            gap:10px;
        }

        /* CONTENT */
        .driver-content{
            padding:24px;
        }

        .driver-name{
            font-size:24px;
            font-weight:700;
            margin-bottom:10px;
        }

        .driver-info{
            color:#cbd5e1;
            font-size:14px;
            margin-bottom:8px;
        }

        .driver-info span{
            color:white;
            font-weight:600;
        }

        .badge{
            display:inline-block;
            padding:8px 16px;
            border-radius:999px;
            font-size:12px;
            font-weight:700;
            margin:15px 0;
        }

        .approved{
            background:#16a34a;
            color:white;
        }

        .pending{
            background:#3b82f6;
            color:white;
        }

        .current-feedback{
            background:rgba(245,158,11,0.1);
            border-left:4px solid #f59e0b;
            padding:12px;
            margin-bottom:20px;
            border-radius:10px;
            font-size:13px;
        }

        .feedback-tag{
            color:#f59e0b;
            font-weight:800;
            font-size:10px;
            text-transform:uppercase;
            display:block;
            margin-bottom:5px;
        }

        .actions{
            display:flex;
            flex-direction:column;
            gap:12px;
            border-top:1px solid rgba(255,255,255,0.1);
            padding-top:20px;
        }

        .comment-area{
            width:100%;
            background:#1e293b;
            border:1px solid rgba(255,255,255,0.1);
            border-radius:12px;
            padding:12px;
            color:white;
            font-family:inherit;
            resize:none;
            outline:none;
        }

        .comment-area:focus{
            border-color:#3b82f6;
        }

        .btn{
            width:100%;
            padding:12px;
            border:none;
            border-radius:12px;
            font-weight:700;
            cursor:pointer;
            transition:0.3s ease;
        }

        .approve-btn{
            background:#16a34a;
            color:white;
        }

        .update-btn{
            background:#1e293b;
            color:#cbd5e1;
            border:1px solid rgba(255,255,255,0.1);
        }

        .empty{
            background:#111827;
            border-radius:20px;
            padding:60px;
            text-align:center;
            color:#94a3b8;
            font-size:18px;
        }

        .section-title{
            font-size:24px;
            font-weight:800;
            margin-bottom:25px;
            margin-top:20px;
        }
    </style>
</head>

<body>

<div class="main">

    <!-- HEADER -->
    <div class="header">

        <div class="title">
            🚍 Driver Verification Dashboard
        </div>

        <div class="top-actions">

            <div class="status-online">
                🟢 Admin Online
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    Logout
                </button>
            </form>

        </div>
    </div>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- STATS -->
    <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-title">Total Drivers</div>
            <div class="stat-number total-color">
                {{ $drivers->count() }}
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-title">Approved Drivers</div>
            <div class="stat-number approved-color">
                {{ $drivers->where('is_approved', 1)->count() }}
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-title">Pending Drivers</div>
            <div class="stat-number pending-color">
                {{ $drivers->where('is_approved', 0)->count() }}
            </div>
        </div>

    </div>

    <!-- PENDING SECTION -->
    <div class="section-title">
        ⏳ Pending Drivers
    </div>

    <div class="driver-grid">

        @foreach($drivers->where('is_approved', 0) as $driver)

        <div class="driver-card">

            <!-- IMAGES -->
            <div class="driver-image-container">

                <!-- LICENSE -->
                <div class="img-slot">

                    <span class="img-tag">
                        LICENSE
                    </span>

                    @if($driver->license_path)

                        <a href="{{ asset('storage/' . $driver->license_path) }}" target="_blank">

                            <img
                                src="{{ asset('storage/' . $driver->license_path) }}"
                                class="driver-image"
                            >

                        </a>

                    @else

                        <div class="image-error">
                            🚫
                            <span>Not Uploaded</span>
                        </div>

                    @endif

                </div>

                <!-- ORCR -->
                <div class="img-slot">

                    <span class="img-tag">
                        OR / CR
                    </span>

                    @if($driver->orcr_path)

                        <a href="{{ asset('storage/' . $driver->orcr_path) }}" target="_blank">

                            <img
                                src="{{ asset('storage/' . $driver->orcr_path) }}"
                                class="driver-image"
                            >

                        </a>

                    @elseif($driver->permit_path)

                        <a href="{{ asset('storage/' . $driver->permit_path) }}" target="_blank">

                            <img
                                src="{{ asset('storage/' . $driver->permit_path) }}"
                                class="driver-image"
                            >

                        </a>

                    @else

                        <div class="image-error">
                            🚫
                            <span>Not Uploaded</span>
                        </div>

                    @endif

                </div>

            </div>

            <!-- CONTENT -->
            <div class="driver-content">

                <div class="driver-name">
                    {{ $driver->name }}
                </div>

                <div class="driver-info">
                    Email:
                    <span>{{ $driver->email }}</span>
                </div>

                <div class="badge pending">
                    ⏳ Pending Verification
                </div>

                @if($driver->admin_comment)

                    <div class="current-feedback">

                        <span class="feedback-tag">
                            Current Feedback
                        </span>

                        "{{ $driver->admin_comment }}"

                    </div>

                @endif

                <div class="actions">

                    <!-- APPROVE -->
                    <form action="{{ route('admin.driver.approve', $driver->id) }}" method="POST">

                        @csrf

                        <button type="submit" class="btn approve-btn">
                            Approve Application
                        </button>

                    </form>

                    <!-- FEEDBACK -->
                    <form action="{{ route('admin.driver.reject', $driver->id) }}" method="POST">

                        @csrf

                        <textarea
                            name="admin_comment"
                            class="comment-area"
                            rows="2"
                            placeholder="Write feedback..."
                            required
                        >{{ $driver->admin_comment }}</textarea>

                        <button
                            type="submit"
                            class="btn update-btn"
                            style="margin-top:8px;"
                        >
                            Update Feedback
                        </button>

                    </form>

                </div>

            </div>

        </div>

        @endforeach

    </div>

    <!-- APPROVED SECTION -->
    <div class="section-title" style="margin-top:60px;">
        ✅ Approved Drivers
    </div>

    <div class="driver-grid">

        @foreach($drivers->where('is_approved', 1) as $driver)

        <div class="driver-card">

            <div class="driver-image-container">

                <!-- LICENSE -->
                <div class="img-slot">

                    <span class="img-tag">
                        LICENSE
                    </span>

                    @if($driver->license_path)

                        <a href="{{ asset('storage/' . $driver->license_path) }}" target="_blank">

                            <img
                                src="{{ asset('storage/' . $driver->license_path) }}"
                                class="driver-image"
                            >

                        </a>

                    @else

                        <div class="image-error">
                            🚫
                            <span>Not Uploaded</span>
                        </div>

                    @endif

                </div>

                <!-- ORCR -->
                <div class="img-slot">

                    <span class="img-tag">
                        OR / CR
                    </span>

                    @if($driver->orcr_path)

                        <a href="{{ asset('storage/' . $driver->orcr_path) }}" target="_blank">

                            <img
                                src="{{ asset('storage/' . $driver->orcr_path) }}"
                                class="driver-image"
                            >

                        </a>

                    @elseif($driver->permit_path)

                        <a href="{{ asset('storage/' . $driver->permit_path) }}" target="_blank">

                            <img
                                src="{{ asset('storage/' . $driver->permit_path) }}"
                                class="driver-image"
                            >

                        </a>

                    @else

                        <div class="image-error">
                            🚫
                            <span>Not Uploaded</span>
                        </div>

                    @endif

                </div>

            </div>

            <div class="driver-content">

                <div class="driver-name">
                    {{ $driver->name }}
                </div>

                <div class="driver-info">
                    Email:
                    <span>{{ $driver->email }}</span>
                </div>

                <div class="badge approved">
                    ✅ Approved
                </div>

                <div class="actions">

                    <p style="font-size:13px; color:#94a3b8; text-align:center;">
                        This driver is verified and approved.
                    </p>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>

</body>
</html>