<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --bg: #0f172a; /* slate-900 */
            --bg-muted: #111827; /* gray-900 */
            --card: #111827; /* gray-900 */
            --card-border: #1f2937; /* gray-800 */
            --text: #e5e7eb; /* gray-200 */
            --text-muted: #9ca3af; /* gray-400 */
            --primary: #6366f1; /* indigo-500 */
            --primary-600: #4f46e5;
            --accent: #22d3ee; /* cyan-400 */
            --success: #10b981; /* emerald-500 */
        }
        * { box-sizing: border-box; }
        html, body { height: 100%; }
        body {
            margin: 0;
            font-family: 'Inter', system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
            color: var(--text);
            background: radial-gradient(1200px 600px at 10% -10%, rgba(79,70,229,0.25), transparent 60%),
                        radial-gradient(1000px 500px at 100% 0%, rgba(34,211,238,0.18), transparent 60%),
                        var(--bg);
        }
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 32px 20px 64px;
        }
        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0 24px;
        }
        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            letter-spacing: 0.4px;
            color: #fff;
            text-decoration: none;
        }
        .brand .logo {
            height: 36px;
            width: 36px;
            display: grid;
            place-items: center;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            box-shadow: 0 10px 20px rgba(99,102,241,0.35);
        }
        .hero {
            padding: 24px 0 8px;
            text-align: center;
        }
        .hero h1 {
            margin: 0;
            font-size: 36px;
            line-height: 1.2;
            font-weight: 800;
            letter-spacing: -0.02em;
        }
        .hero p {
            margin: 14px auto 0;
            max-width: 820px;
            color: var(--text-muted);
            font-size: 16px;
        }
        .cta-row {
            margin-top: 28px;
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 18px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            color: white;
            transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.2s ease;
            will-change: transform;
            border: 1px solid rgba(255,255,255,0.08);
        }
        .btn:hover { transform: translateY(-2px); }
        .btn-primary { background: linear-gradient(135deg, var(--primary), var(--primary-600)); box-shadow: 0 10px 18px rgba(79,70,229,0.35); }
        .btn-secondary { background: linear-gradient(135deg, #0ea5e9, #0284c7); box-shadow: 0 10px 18px rgba(14,165,233,0.35); }

        .grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 16px;
            margin-top: 36px;
        }
        .card {
            grid-column: span 12;
            background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
            border: 1px solid var(--card-border);
            border-radius: 14px;
            padding: 22px;
            backdrop-filter: blur(6px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.25);
        }
        @media (min-width: 768px) {
            .card { grid-column: span 6; }
        }
        .card h3 {
            margin: 0 0 8px 0;
            font-size: 20px;
        }
        .card p {
            margin: 0 0 14px 0;
            color: var(--text-muted);
            font-size: 14px;
        }
        .card .meta {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-muted);
            font-size: 13px;
            margin-top: 6px;
        }
        .pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(99,102,241,0.14);
            color: #c7d2fe;
            font-weight: 600;
            border: 1px solid rgba(99,102,241,0.35);
            font-size: 13px;
        }
        .footer {
            margin-top: 48px;
            padding-top: 18px;
            border-top: 1px solid var(--card-border);
            color: var(--text-muted);
            font-size: 13px;
            text-align: center;
        }
        .icon {
            height: 36px;
            width: 36px;
            display: inline-grid;
            place-items: center;
            border-radius: 10px;
            background: rgba(255,255,255,0.06);
            border: 1px solid var(--card-border);
            margin-right: 10px;
        }
        .link-inline { color: #93c5fd; text-decoration: none; }
        .link-inline:hover { text-decoration: underline; }
    </style>
    
</head>
<body>
    <div class="container">
        <div class="nav">
            <a class="brand" href="/">
                <span class="logo"><i class="fas fa-tools"></i></span>
                <span>Projects for Learning</span>
            </a>
            <span class="pill"><i class="fas fa-code"></i> Laravel 8</span>
        </div>

        <section class="hero">
            <h1>Developer Utilities: File Converter & Language Translator</h1>
            <p>
                This project showcases two practical tools built with Laravel: a Word↔PDF file converter and a
                language translator UI powered by client-side JavaScript. Use the quick links below to get started.
            </p>
            <div class="cta-row">
                <a href="{{ route('converter') }}" class="btn btn-primary"><i class="fas fa-file-export"></i> Open File Converter</a>
                <a href="{{ route('translator') }}" class="btn btn-secondary"><i class="fas fa-language"></i> Open Translator</a>
            </div>
        </section>

        <section class="grid">
            <article class="card">
                <h3><span class="icon"><i class="fas fa-file-word"></i></span>Word to PDF, PDF to Word</h3>
                <p>
                    Convert <strong>.doc/.docx</strong> files to <strong>PDF</strong>, and extract text from <strong>PDF</strong> to generate
                    a new <strong>.docx</strong>. Implemented with <em>PhpWord</em>, <em>DOMPDF</em>, and <em>Spatie PDF-to-Text</em>.
                </p>
                <div class="meta">
                    <span><i class="fas fa-shield-alt"></i> Server-side processing</span>
                    <span><i class="fas fa-download"></i> Files saved to storage & downloadable</span>
                </div>
                <div class="cta-row" style="justify-content:flex-start;margin-top:14px;">
                    <a href="{{ route('converter') }}" class="btn btn-primary"><i class="fas fa-play"></i> Try Converter</a>
                </div>
            </article>

            <article class="card">
                <h3><span class="icon"><i class="fas fa-comments"></i></span>Language Translator UI</h3>
                <p>
                    A clean, responsive interface to input text and view translations side-by-side. Powered by static
                    JavaScript and ready-to-use assets under <code>public/js</code>.
                </p>
                <div class="meta">
                    <span><i class="fas fa-magic"></i> Client-side experience</span>
                    <span><i class="fas fa-desktop"></i> Accessible and responsive</span>
                </div>
                <div class="cta-row" style="justify-content:flex-start;margin-top:14px;">
                    <a href="{{ route('translator') }}" class="btn btn-secondary"><i class="fas fa-play"></i> Try Translator</a>
                </div>
            </article>
        </section>

        <div class="footer">
            <div>
                Need the API? Use the endpoints documented in the <a class="link-inline" href="/README.md">README</a>.
            </div>
            <div style="margin-top:6px;">Built with ❤️ using Laravel and modern PHP libraries.</div>
        </div>
    </div>
</body>
</html>