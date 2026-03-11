<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Issue</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #0f1117; --surface: #1a1d27; --border: #2a2d3d;
            --accent: #6c63ff; --accent-glow: rgba(108, 99, 255, 0.35);
            --text: #e8e9f0; --muted: #7b7e96;
        }
        body {
            font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--text);
            min-height: 100vh; display: flex; align-items: center; justify-content: center;
            padding: 1rem;
            background-image: radial-gradient(ellipse at 20% 50%, rgba(108,99,255,0.08) 0%, transparent 60%),
                              radial-gradient(ellipse at 80% 20%, rgba(99,179,255,0.06) 0%, transparent 50%);
        }
        .card {
            background: var(--surface); border: 1px solid var(--border); border-radius: 16px;
            padding: 1.8rem; width: 100%; max-width: 580px;
            box-shadow: 0 0 60px rgba(0,0,0,0.4);
            animation: fadeUp 0.5s ease both;
        }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: translateY(0); } }
        .badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(108,99,255,0.12); border: 1px solid rgba(108,99,255,0.3);
            color: #a89fff; font-size: 0.68rem; font-weight: 600; letter-spacing: 0.08em;
            text-transform: uppercase; padding: 4px 10px; border-radius: 999px; margin-bottom: 0.6rem;
        }
        .badge::before {
            content: ''; width: 5px; height: 5px; background: var(--accent);
            border-radius: 50%; box-shadow: 0 0 6px var(--accent); animation: pulse 2s infinite;
        }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.4; } }
        h1 {
            font-family: 'Syne', sans-serif; font-size: 1.6rem; font-weight: 800;
            line-height: 1.15; margin-bottom: 0.2rem;
            background: linear-gradient(135deg, #e8e9f0 30%, #a89fff);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .subtitle { color: var(--muted); font-size: 0.82rem; margin-bottom: 1rem; }
        .divider { height: 1px; background: var(--border); margin-bottom: 1rem; }
        .row { display: grid; grid-template-columns: 1fr 1fr; gap: 0.8rem; }
        .field { margin-bottom: 0.8rem; }
        label {
            display: block; font-size: 0.75rem; font-weight: 600; color: var(--muted);
            letter-spacing: 0.05em; text-transform: uppercase; margin-bottom: 0.3rem;
        }
        .optional { color: #4a4d63; font-size: 0.68rem; margin-left: 4px; text-transform: none; letter-spacing: 0; }
        input[type="text"], input[type="email"], textarea {
            width: 100%; background: rgba(255,255,255,0.03); border: 1px solid var(--border);
            border-radius: 8px; padding: 0.6rem 0.8rem; color: var(--text);
            font-family: 'DM Sans', sans-serif; font-size: 0.88rem;
            transition: border-color 0.2s, box-shadow 0.2s; outline: none; resize: none;
        }
        input[type="text"]:focus, input[type="email"]:focus, textarea:focus {
            border-color: var(--accent); box-shadow: 0 0 0 3px var(--accent-glow);
            background: rgba(108,99,255,0.05);
        }
        textarea { height: 80px; }
        button[type="submit"] {
            width: 100%; background: var(--accent); color: #fff;
            font-family: 'DM Sans', sans-serif; font-size: 0.9rem; font-weight: 600;
            border: none; border-radius: 8px; padding: 0.75rem; cursor: pointer;
            margin-top: 0.3rem; transition: background 0.2s, transform 0.1s, box-shadow 0.2s;
            box-shadow: 0 4px 20px rgba(108,99,255,0.35); letter-spacing: 0.02em;
        }
        button[type="submit"]:hover { background: #7c75ff; box-shadow: 0 6px 28px rgba(108,99,255,0.5); transform: translateY(-1px); }
        button[type="submit"]:active { transform: translateY(0); }
        .alert {
            border-radius: 8px; padding: 0.7rem 1rem; font-size: 0.85rem;
            margin-bottom: 1rem; display: flex; align-items: flex-start; gap: 10px;
            animation: fadeUp 0.3s ease both;
        }
        .alert-success { background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.3); color: #86efac; }
        .alert-error { background: rgba(248,113,113,0.1); border: 1px solid rgba(248,113,113,0.3); color: #fca5a5; }
        .alert-icon { font-size: 1rem; flex-shrink: 0; margin-top: 1px; }
        .section-label {
            font-size: 0.7rem; font-weight: 700; color: #4a4d63;
            text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.6rem; margin-top: 0.3rem;
        }
    </style>
</head>
<body>
<div class="card">
    <div class="badge">Issue Tracker</div>
    <h1>Report an Issue</h1>
    <p class="subtitle">Found a bug or have a suggestion? Let us know below.</p>
    <div class="divider"></div>

    @if(session('success'))
    <div class="alert alert-success">
        <span class="alert-icon">✓</span>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    @if(isset($errors) && $errors->any())
    <div class="alert alert-error">
        <span class="alert-icon">✕</span>
        <ul style="list-style:none; padding:0;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ url('/submit-issue') }}">
        @csrf

        <div class="section-label">Issue Details</div>

        <div class="row">
            <div class="field">
                <label for="title">Issue Title</label>
                <input type="text" id="title" name="title" placeholder="e.g. Login button not working" value="{{ old('title') }}">
            </div>
            <div class="field">
                <label for="repository">Repository / Project</label>
                <input type="text" id="repository" name="repository" placeholder="e.g. myuser/myrepo" value="{{ old('repository') }}">
            </div>
        </div>

        <div class="field">
            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Describe the issue in detail...">{{ old('description') }}</textarea>
        </div>

        <div class="field">
            <label for="labels">Labels <span class="optional">(optional)</span></label>
            <input type="text" id="labels" name="labels" placeholder="e.g. bug, urgent" value="{{ old('labels') }}">
        </div>

        <div class="section-label" style="margin-top: 0.8rem;">Your Details</div>

        <div class="row">
            <div class="field">
                <label for="submitter_name">Your Name <span class="optional">(optional)</span></label>
                <input type="text" id="submitter_name" name="submitter_name" placeholder="e.g. John Doe" value="{{ old('submitter_name') }}">
            </div>
            <div class="field">
                <label for="submitter_email">Your Email <span class="optional">(optional)</span></label>
                <input type="email" id="submitter_email" name="submitter_email" placeholder="e.g. john@example.com" value="{{ old('submitter_email') }}">
            </div>
        </div>

        <button type="submit">Submit Issue →</button>
    </form>
</div>
</body>
</html>