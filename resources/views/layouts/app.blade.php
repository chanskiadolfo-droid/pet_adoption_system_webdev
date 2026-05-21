<!DOCTYPE html>
<html>
<head>
    <title>Pet Adoption System</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #e0f2fe, #fef3c7, #dcfce7);
            color: #1f2937;
        }

        .navbar {
            background: #065f46;
            color: white;
            padding: 18px 45px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a, .navbar button {
            color: white;
            text-decoration: none;
            margin-left: 16px;
            background: none;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        .container {
            width: 92%;
            max-width: 1150px;
            margin: 35px auto;
        }

        .panel {
            background: rgba(255,255,255,0.95);
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 12px 30px rgba(6,95,70,0.18);
        }

        .btn {
            display: inline-block;
            padding: 9px 14px;
            border-radius: 8px;
            background: #047857;
            color: white;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-light {
            background: #e5e7eb;
            color: #111827;
        }

        .btn-warning {
            background: #f59e0b;
            color: #111827;
        }

        .btn-danger {
            background: #dc2626;
        }

        input, textarea, select {
            width: 100%;
            padding: 11px;
            margin: 8px 0 16px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            box-sizing: border-box;
        }

        textarea {
            min-height: 100px;
        }

        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            margin-top: 18px;
        }

        th, td {
            padding: 13px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            background: #bbf7d0;
        }

        .success {
            background: #dcfce7;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .error {
            background: #fee2e2;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .badge {
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .available, .approved {
            background: #dcfce7;
            color: #166534;
        }

        .adopted, .rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .pending {
            background: #fef3c7;
            color: #92400e;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            border-left: 6px solid #047857;
        }

        .card h3 {
            margin: 0;
            font-size: 32px;
            color: #047857;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <strong>Pet Adoption System</strong>

        @auth
            <div>
                <span>{{ auth()->user()->name }} | {{ strtoupper(auth()->user()->role) }}</span>
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('pets.index') }}">Pets</a>
                <a href="{{ route('adoptions.index') }}">Adoptions</a>

                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('users.index') }}">Users</a>
                @endif

                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        @endauth
    </div>

    <div class="container">
        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>
