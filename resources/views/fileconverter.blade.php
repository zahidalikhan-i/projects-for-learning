<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Converter</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --bg: #0f172a;
            --card: #111827;
            --card-border: #1f2937;
            --text: #e5e7eb;
            --muted: #9ca3af;
            --primary: #6366f1;
            --primary-600: #4f46e5;
            --success: #10b981;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
            font-family: 'Inter', system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
            color: var(--text);
            background: radial-gradient(1000px 500px at 100% 0%, rgba(99, 102, 241, 0.18), transparent 60%),
                radial-gradient(1000px 500px at 0% 0%, rgba(16, 185, 129, 0.15), transparent 60%),
                var(--bg);
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 28px 18px 56px;
        }

        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0 22px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
        }

        .logo {
            height: 34px;
            width: 34px;
            display: grid;
            place-items: center;
            border-radius: 9px;
            background: linear-gradient(135deg, var(--primary), #22d3ee);
            box-shadow: 0 10px 18px rgba(99, 102, 241, 0.35);
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(99, 102, 241, 0.14);
            color: #c7d2fe;
            font-weight: 600;
            border: 1px solid rgba(99, 102, 241, 0.35);
            font-size: 13px;
        }

        .pill-logout {
            background: #ffffff;
            color: #020617;
            border-color: rgba(148, 163, 184, 0.9);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.12);
            cursor: pointer;
        }

        .hero {
            text-align: center;
            padding: 18px 0 10px;
        }

        .hero h1 {
            margin: 0;
            font-size: 30px;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .hero p {
            margin: 10px auto 0;
            max-width: 760px;
            color: var(--muted);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 16px;
            margin-top: 26px;
        }

        .card {
            grid-column: span 12;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.03), rgba(255, 255, 255, 0.02));
            border: 1px solid var(--card-border);
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
        }

        @media (min-width: 768px) {
            .card {
                grid-column: span 6;
            }
        }

        .card h3 {
            margin: 0 0 8px 0;
            font-size: 18px;
        }

        .card p {
            margin: 0 0 12px 0;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.5;
            min-height: 42px;
            /* ensures both card descriptions take up the same vertical space so inputs/buttons align */
        }

        .form-row {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        input[type="file"] {
            color: var(--muted);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.08);
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-600));
            box-shadow: 0 8px 16px rgba(79, 70, 229, 0.35);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success), #059669);
            box-shadow: 0 8px 16px rgba(16, 185, 129, 0.35);
        }

        .btn-secondary {
            background: rgba(15, 23, 42, 0.85);
            border-color: rgba(148, 163, 184, 0.7);
            color: #e5e7eb;
            box-shadow: 0 8px 16px rgba(15, 23, 42, 0.45);
        }

        .btn-ghost {
            background: transparent;
            border-color: rgba(148, 163, 184, 0.5);
            color: #e5e7eb;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        /* no layout change on larger screens so both cards stay aligned:
           file input on first row, convert button on second row */

        .error {
            color: #fecaca;
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.35);
            padding: 10px 12px;
            border-radius: 10px;
            margin-bottom: 12px;
        }

        .meta {
            color: var(--muted);
            font-size: 13px;
            margin-top: 8px;
        }

        .progress {
            height: 6px;
            background: rgba(99, 102, 241, 0.2);
            border-radius: 999px;
            overflow: hidden;
            margin-top: 10px;
            display: none;
        }

        .bar {
            height: 100%;
            width: 0%;
            background: linear-gradient(135deg, var(--primary), var(--primary-600));
            transition: width 0.2s ease;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="nav">
            <a class="brand"><span class="logo"><i class="fas fa-file-export"></i></span> <span>File Converter</span></a>
            <div style="display:flex; align-items:center; gap:10px;">
                <a href="/" class="btn btn-ghost" style="padding:8px 12px;"><i class="fas fa-home"></i> Home</a>
                <span class="pill" id="userPill" title="User" style="display:none;"><i class="fas fa-user"></i> <span id="userName"></span></span>
                <a href="/login" id="loginBtn" class="btn btn-primary" style="display:none; padding:8px 12px;"><i class="fas fa-sign-in-alt"></i> Login</a>
                <button id="logoutBtn" class="pill pill-logout" style="display:none;"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </div>
        </div>

        <section class="hero">
            <h1>Convert Documents with Ease</h1>
            <p>Upload a Word document to generate a PDF, or extract text from a PDF and download a fresh .docx. Files are processed securely on the server.</p>
        </section>

        @if (session('error'))
        <div class="error">{{ session('error') }}</div>
        @endif

        <section class="grid">
            <article class="card" style="grid-column: span 12; display:none;" id="guestBanner">
                <p style="margin:0;">You are viewing as <strong>Guest</strong>. Please <a href="/login" class="link-inline">login</a> to enable file conversions.</p>
            </article>
            <article class="card">
                <h3><i class="fas fa-file-word"></i> Word (.doc/.docx) → PDF</h3>
                <p>Select a Word file and convert it to a downloadable PDF.</p>
                <form class="form-row" id="formWordToPdf" action="{{ route('convert.word.to.pdf') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="word_file" accept=".doc,.docx" required>
                    <button type="submit" class="btn btn-primary" id="btnWordToPdf"><i class="fas fa-file-pdf"></i> Convert to PDF</button>
                </form>
                <div class="progress" id="progWord">
                    <div class="bar" id="barWord"></div>
                </div>
                <div class="meta"><i class="fas fa-info-circle"></i> Output path: storage/app/public/converted.pdf</div>
            </article>

            <article class="card">
                <h3><i class="fas fa-file-pdf"></i> PDF → Word (.docx)</h3>
                <p>Extract text from a PDF and create a new Word document.</p>
                <form class="form-row" id="formPdfToWord" action="{{ route('convert.pdf.to.word') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="pdf_file" accept=".pdf" required>
                    <button type="submit" class="btn btn-success" id="btnPdfToWord"><i class="fas fa-file-word"></i> Convert to Word</button>
                </form>
                <div class="progress" id="progPdf">
                    <div class="bar" id="barPdf"></div>
                </div>
                <div class="meta"><i class="fas fa-info-circle"></i> Output path: storage/app/public/converted.docx</div>
            </article>

            <article class="card" style="grid-column: span 12;">
                <h3><i class="fas fa-download"></i> Download the Last Converted File</h3>
                <p>Downloads the most recent file you converted (PDF or DOCX).</p>
                <form class="form-row" action="{{ route('download.last') }}" method="GET">
                    <button type="submit" class="btn btn-primary" id="btnDownload"><i class="fas fa-download"></i> Download File</button>
                </form>
            </article>
        </section>
    </div>
    <script>
        (function() {
            const token = localStorage.getItem('api_token');
            const banner = document.getElementById('guestBanner');
            const buttons = [document.getElementById('btnWordToPdf'), document.getElementById('btnPdfToWord'), document.getElementById('btnDownload')];
            const nameEl = document.getElementById('userName');
            const userPill = document.getElementById('userPill');
            const loginBtn = document.getElementById('loginBtn');
            const logoutBtn = document.getElementById('logoutBtn');
            if (!token) {
                banner.style.display = 'block';
                buttons.forEach(b => {
                    if (b) {
                        b.disabled = true;
                        b.style.opacity = 0.6;
                        b.style.cursor = 'not-allowed';
                    }
                });
                loginBtn && (loginBtn.style.display = 'inline-flex');
            } else {
                userPill.style.display = 'inline-flex';
                logoutBtn.style.display = 'inline-flex';
                nameEl.textContent = 'Loading…';
                fetch('/api/user', {
                        headers: {
                            'Authorization': 'Bearer ' + token
                        }
                    })
                    .then(async (res) => {
                        if (!res.ok) throw new Error('Unauthorized');
                        return res.json();
                    })
                    .then((user) => {
                        if (user && user.name) {
                            nameEl.textContent = user.name;
                            localStorage.setItem('user', JSON.stringify(user));
                        }
                    })
                    .catch(() => {
                        localStorage.removeItem('api_token');
                        localStorage.removeItem('user');
                        userPill.style.display = 'none';
                        logoutBtn.style.display = 'none';
                        loginBtn.style.display = 'inline-flex';
                    });
            }
            logoutBtn && logoutBtn.addEventListener('click', function() {
                localStorage.removeItem('api_token');
                localStorage.removeItem('user');
                location.reload();
            });
            // Handle loading bar + localStorage last type
            function handleForm(formId, barId, progId, typeKey) {
                const form = document.getElementById(formId);
                const bar = document.getElementById(barId);
                const prog = document.getElementById(progId);
                if (!form) return;
                form.addEventListener('submit', function() {
                    if (!token) {
                        return;
                    }
                    prog.style.display = 'block';
                    bar.style.width = '15%';
                    let p = 15;
                    const iv = setInterval(() => {
                        p = Math.min(95, p + Math.random() * 10);
                        bar.style.width = p + '%';
                    }, 300);
                    // allow normal submit; after download starts, store type
                    setTimeout(() => {
                        try {
                            localStorage.setItem('last_converted_type', typeKey);
                        } catch {}
                    }, 1000);
                    // best effort cleanup
                    setTimeout(() => {
                        clearInterval(iv);
                        bar.style.width = '100%';
                    }, 60000);
                });
            }
            handleForm('formWordToPdf', 'barWord', 'progWord', 'pdf');
            handleForm('formPdfToWord', 'barPdf', 'progPdf', 'docx');
        })();
    </script>
</body>

</html>