<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Language Translator App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
      :root { --bg:#0f172a; --text:#e5e7eb; --muted:#9ca3af; --primary:#6366f1; --primary-600:#4f46e5; --card:#111827; --card-border:#1f2937; }
      * { box-sizing: border-box; }
      html, body { height: 100%; }
      body { margin:0; font-family:'Inter', system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif; color:var(--text); background: radial-gradient(1000px 500px at 100% 0%, rgba(99,102,241,0.16), transparent 60%), var(--bg); }
      .container { max-width: 980px; margin: 0 auto; padding: 28px 18px 56px; }
      .nav { display:flex; align-items:center; justify-content:space-between; padding:10px 0 22px; }
      .brand { display:inline-flex; align-items:center; gap:10px; font-weight:700; color:#fff; text-decoration:none; }
      .logo { height:34px; width:34px; display:grid; place-items:center; border-radius:9px; background: linear-gradient(135deg, var(--primary), #22d3ee); box-shadow:0 10px 18px rgba(99,102,241,0.35); }
      .pill { display:inline-flex; align-items:center; gap:8px; padding:8px 12px; border-radius:999px; background: rgba(99,102,241,0.14); color:#c7d2fe; font-weight:600; border:1px solid rgba(99,102,241,0.35); font-size:13px; }

      .hero { text-align:center; padding: 18px 0 18px; }
      .hero h1 { margin:0; font-size:30px; font-weight:800; letter-spacing:-0.02em; }
      .hero p { margin:10px auto 0; max-width:760px; color:var(--muted); }

      .panel { background: linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.02)); border:1px solid var(--card-border); border-radius:14px; padding:18px; box-shadow:0 12px 30px rgba(0,0,0,0.25); }
      .text-input { display:grid; grid-template-columns: 1fr 1fr; gap:14px; }
      @media (max-width: 768px) { .text-input { grid-template-columns: 1fr; } }
      textarea { width:100%; min-height:200px; resize:vertical; background:#0b1220; color:var(--text); border:1px solid var(--card-border); border-radius:10px; padding:12px; font-family:inherit; }
      .controls { list-style:none; padding:0; margin:14px 0 0 0; display:flex; gap:12px; align-items:center; flex-wrap:wrap; }
      .row { display:flex; align-items:center; gap:10px; }
      .icons { display:inline-flex; align-items:center; gap:10px; }
      select { background:#0b1220; color:var(--text); border:1px solid var(--card-border); border-radius:10px; padding:10px; }
      .exchange { display:inline-grid; place-items:center; height:40px; width:40px; border-radius:10px; background: rgba(99,102,241,0.14); border:1px solid rgba(99,102,241,0.35); color:#c7d2fe; }
      button.translate { margin-top:14px; display:inline-flex; align-items:center; gap:10px; padding:12px 18px; border-radius:10px; background: linear-gradient(135deg, var(--primary), var(--primary-600)); color:#fff; border:1px solid rgba(255,255,255,0.08); font-weight:600; cursor:pointer; }
      .love { margin-top:18px; text-align:center; color:var(--muted); }
      .love a { color:#93c5fd; text-decoration:none; }
      .love a:hover { text-decoration:underline; }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="nav">
        <a class="brand" href="/"><span class="logo"><i class="fas fa-language"></i></span><span>Language Translator</span></a>
        <div style="display:flex; align-items:center; gap:10px;">
          <span class="pill" id="userPill" title="User" style="display:none;"><i class="fas fa-user"></i> <span id="userName"></span></span>
          <a href="/login" id="loginBtn" class="btn" style="display:none; padding:8px 12px; background:linear-gradient(135deg, var(--primary), var(--primary-600)); border:1px solid rgba(255,255,255,0.08); color:#fff; font-weight:600; border-radius:10px; text-decoration:none;"><i class="fas fa-sign-in-alt"></i> Login</a>
          <button id="logoutBtn" class="btn" style="display:none; padding:8px 12px; background:rgba(255,255,255,0.06); border:1px solid var(--card-border); color:#fff; font-weight:600; border-radius:10px;">
            <i class="fas fa-sign-out-alt"></i> Logout
          </button>
        </div>
      </div>

      <section class="hero">
        <h1>Translate Text Instantly</h1>
        <p>Type or paste your text, pick source and target languages, and view the translation side-by-side.</p>
      </section>

      <div class="panel">
        <div class="error" id="guestBanner" style="display:none; color:#fecaca; background:rgba(239,68,68,0.12); border:1px solid rgba(239,68,68,0.35); padding:10px 12px; border-radius:10px; margin-bottom:12px;">You are viewing as <strong>Guest</strong>. Please <a href="/login" style="color:#93c5fd;">login</a> to enable translation actions.</div>
        <div class="text-input">
          <textarea spellcheck="false" class="from-text" placeholder="Enter text"></textarea>
          <textarea spellcheck="false" readonly disabled class="to-text" placeholder="Translation"></textarea>
        </div>
        <ul class="controls">
          <li class="row from">
            <div class="icons">
              <i id="from" class="fas fa-volume-up"></i>
              <i id="from" class="fas fa-copy"></i>
            </div>
            <select></select>
          </li>
          <li class="exchange"><i class="fas fa-exchange-alt"></i></li>
          <li class="row to">
            <select></select>
            <div class="icons">
              <i id="to" class="fas fa-volume-up"></i>
              <i id="to" class="fas fa-copy"></i>
            </div>
          </li>
        </ul>
        <button class="translate" id="btnTranslate"><i class="fas fa-play"></i> Translate Text</button>
      </div>

      <div class="love">
        Made with &hearts; by
        <a href="#" target="_blank" rel="noopener noreferrer">zahid ali khan</a>
      </div>
    </div>

    <script src="{{ asset('js/countries.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
      (function(){
        const token = localStorage.getItem('api_token');
        const banner = document.getElementById('guestBanner');
        const translate = document.getElementById('btnTranslate');
        const nameEl = document.getElementById('userName');
        const userPill = document.getElementById('userPill');
        const loginBtn = document.getElementById('loginBtn');
        const logoutBtn = document.getElementById('logoutBtn');
        if(!token){
          if(banner) banner.style.display = 'block';
          if(translate){ translate.disabled = true; translate.style.opacity = 0.6; translate.style.cursor = 'not-allowed'; }
          loginBtn && (loginBtn.style.display = 'inline-flex');
        } else {
          userPill.style.display = 'inline-flex';
          logoutBtn.style.display = 'inline-flex';
          nameEl.textContent = 'Loading…';
          fetch('/api/user', { headers: { 'Authorization': 'Bearer ' + token } })
            .then(async (res) => { if(!res.ok) throw new Error('Unauthorized'); return res.json(); })
            .then((user) => { if(user && user.name){ nameEl.textContent = user.name; localStorage.setItem('user', JSON.stringify(user)); } })
            .catch(() => { localStorage.removeItem('api_token'); localStorage.removeItem('user'); userPill.style.display='none'; logoutBtn.style.display='none'; loginBtn.style.display='inline-flex'; });
        }
        logoutBtn && logoutBtn.addEventListener('click', function(){ localStorage.removeItem('api_token'); localStorage.removeItem('user'); location.reload(); });
      })();
    </script>
  </body>
</html>
