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
        * { box-sizing: border-box; }
        html, body { height: 100%; }
        body {
            margin: 0;
            font-family: 'Inter', system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
            color: var(--text);
            background: radial-gradient(1000px 500px at 100% 0%, rgba(99,102,241,0.18), transparent 60%),
                        radial-gradient(1000px 500px at 0% 0%, rgba(16,185,129,0.15), transparent 60%),
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
        .logo { height: 34px; width: 34px; display: grid; place-items: center; border-radius: 9px; background: linear-gradient(135deg, var(--primary), #22d3ee); box-shadow: 0 10px 18px rgba(99,102,241,0.35); }
        .pill { display:inline-flex; align-items:center; gap:8px; padding:8px 12px; border-radius:999px; background: rgba(99,102,241,0.14); color:#c7d2fe; font-weight:600; border:1px solid rgba(99,102,241,0.35); font-size:13px; }

        .hero { text-align:center; padding: 18px 0 10px; }
        .hero h1 { margin:0; font-size:30px; font-weight:800; letter-spacing:-0.02em; }
        .hero p { margin:10px auto 0; max-width:760px; color: var(--muted); }

        .grid { display:grid; grid-template-columns: repeat(12,1fr); gap:16px; margin-top:26px; }
        .card { grid-column: span 12; background: linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.02)); border:1px solid var(--card-border); border-radius:14px; padding:20px; box-shadow: 0 12px 30px rgba(0,0,0,0.25); }
        @media (min-width: 768px) { .card { grid-column: span 6; } }
        .card h3 { margin:0 0 8px 0; font-size:18px; }
        .card p { margin:0 0 12px 0; color: var(--muted); font-size:14px; }

        .form-row { display:flex; align-items:center; gap:10px; flex-wrap:wrap; }
        input[type="file"] { color: var(--muted); }
        .btn { display:inline-flex; align-items:center; gap:8px; padding:10px 14px; border-radius:10px; text-decoration:none; font-weight:600; color:#fff; border:1px solid rgba(255,255,255,0.08); cursor:pointer; }
        .btn-primary { background: linear-gradient(135deg, var(--primary), var(--primary-600)); box-shadow:0 8px 16px rgba(79,70,229,0.35); }
        .btn-success { background: linear-gradient(135deg, var(--success), #059669); box-shadow:0 8px 16px rgba(16,185,129,0.35); }
        .btn:hover { transform: translateY(-1px); }

        .error { color: #fecaca; background: rgba(239,68,68,0.12); border:1px solid rgba(239,68,68,0.35); padding:10px 12px; border-radius:10px; margin-bottom:12px; }
        .meta { color: var(--muted); font-size:13px; margin-top:8px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav">
            <a class="brand" href="/"><span class="logo"><i class="fas fa-file-export"></i></span> <span>File Converter</span></a>
            <span class="pill"><i class="fas fa-shield-alt"></i> Server-side</span>
        </div>

        <section class="hero">
            <h1>Convert Documents with Ease</h1>
            <p>Upload a Word document to generate a PDF, or extract text from a PDF and download a fresh .docx. Files are processed securely on the server.</p>
        </section>

        @if (session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <section class="grid">
            <article class="card">
                <h3><i class="fas fa-file-word"></i> Word (.doc/.docx) → PDF</h3>
                <p>Select a Word file and convert it to a downloadable PDF.</p>
                <form class="form-row" action="{{ route('convert.word.to.pdf') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="word_file" accept=".doc,.docx" required>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-file-pdf"></i> Convert to PDF</button>
                </form>
                <div class="meta"><i class="fas fa-info-circle"></i> Output path: storage/app/public/converted.pdf</div>
            </article>

            <article class="card">
                <h3><i class="fas fa-file-pdf"></i> PDF → Word (.docx)</h3>
                <p>Extract text from a PDF and create a new Word document.</p>
                <form class="form-row" action="{{ route('convert.pdf.to.word') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="pdf_file" accept=".pdf" required>
                    <button type="submit" class="btn btn-success"><i class="fas fa-file-word"></i> Convert to Word</button>
                </form>
                <div class="meta"><i class="fas fa-info-circle"></i> Output path: storage/app/public/converted.docx</div>
            </article>

            <article class="card" style="grid-column: span 12;">
                <h3><i class="fas fa-download"></i> Download Last Converted PDF</h3>
                <p>Download the most recently converted PDF file if available.</p>
                <form class="form-row" action="{{ route('show.pdf') }}" method="GET">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-download"></i> Download PDF</button>
                </form>
            </article>
        </section>
    </div>
</body>
</html>