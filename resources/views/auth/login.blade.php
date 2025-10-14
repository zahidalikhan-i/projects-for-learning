<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root { --bg:#0f172a; --text:#e5e7eb; --muted:#9ca3af; --primary:#6366f1; --primary-600:#4f46e5; --card:#111827; --card-border:#1f2937; }
        * { box-sizing: border-box; }
        html, body { height: 100%; }
        body { margin:0; font-family:'Inter', system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif; color:var(--text); background: radial-gradient(1000px 500px at 100% 0%, rgba(99,102,241,0.16), transparent 60%), var(--bg); }
        .container { max-width: 420px; margin: 0 auto; padding: 28px 18px 56px; }
        .header { text-align:center; margin: 18px 0 18px; }
        h1 { margin:0; font-size:28px; font-weight:800; letter-spacing:-0.02em; }
        p { margin:10px 0 0 0; color:var(--muted); }
        .card { background: linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.02)); border:1px solid var(--card-border); border-radius:14px; padding:20px; box-shadow:0 12px 30px rgba(0,0,0,0.25); }
        label { display:block; font-weight:600; margin-bottom:6px; }
        input { width:100%; padding:12px; border-radius:10px; border:1px solid var(--card-border); background:#0b1220; color:var(--text); }
        .field { margin-bottom:14px; }
        .btn { width:100%; display:inline-flex; justify-content:center; align-items:center; gap:8px; padding:12px 18px; border-radius:10px; background: linear-gradient(135deg, var(--primary), var(--primary-600)); color:#fff; border:1px solid rgba(255,255,255,0.08); font-weight:600; cursor:pointer; }
        .error { color:#fecaca; background:rgba(239,68,68,0.12); border:1px solid rgba(239,68,68,0.35); padding:10px 12px; border-radius:10px; margin:10px 0; }
        .muted { color: var(--muted); font-size:14px; text-align:center; margin-top:10px; }
        a { color:#93c5fd; text-decoration:none; }
        a:hover { text-decoration:underline; }
    </style>
</head>
<body>
    <div class="container">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
            <div style="font-weight:700; letter-spacing:0.3px;">Sign in</div>
            <a href="/" id="guestBtn" style="display:inline-flex; align-items:center; gap:8px; padding:8px 12px; border-radius:10px; background: rgba(99,102,241,0.14); color:#c7d2fe; border:1px solid rgba(99,102,241,0.35); text-decoration:none; font-weight:600;">
                <i class="fas fa-user"></i> Continue as Guest
            </a>
        </div>
        <div class="header">
            <h1>Welcome back</h1>
            <p>Sign in to access the dashboard</p>
        </div>
        <div class="card">
            <div id="error" class="error" style="display:none;"></div>
            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" placeholder="you@example.com" autocomplete="email">
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input id="password" type="password" placeholder="••••••••" autocomplete="current-password">
            </div>
            <button class="btn" id="loginBtn"><i class="fas fa-sign-in-alt"></i> Sign In</button>
            <div class="muted">Don't have an account? <a href="{{ route('register') }}">Create one</a></div>
        </div>
    </div>

    <script>
        (function(){
            const btn = document.getElementById('loginBtn');
            const error = document.getElementById('error');
            btn.addEventListener('click', async function(){
                error.style.display = 'none';
                const email = document.getElementById('email').value.trim();
                const password = document.getElementById('password').value;
                if(!email || !password){
                    error.textContent = 'Email and password are required.';
                    error.style.display = 'block';
                    return;
                }
                try {
                    const res = await fetch('/api/login', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ email, password })
                    });
                    const data = await res.json();
                    if(!res.ok){
                        throw new Error((data && data.message) || 'Login failed');
                    }
                    if(data && data.token){
                        localStorage.setItem('api_token', data.token);
                        localStorage.setItem('user', JSON.stringify(data.user || {}));
                        window.location.href = '/';
                    } else {
                        throw new Error('Invalid response from server');
                    }
                } catch (e) {
                    error.textContent = e.message || 'Login failed';
                    error.style.display = 'block';
                }
            });
            // If already authenticated, redirect to dashboard
            const token = localStorage.getItem('api_token');
            if(token){ window.location.href = '/'; }
        })();
    </script>
</body>
</html>


