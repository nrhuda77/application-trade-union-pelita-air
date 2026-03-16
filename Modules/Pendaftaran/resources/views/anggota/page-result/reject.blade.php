<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Pendaftaran Ditolak</title>

  <style>
    :root{
      --bg:#fef2f2;
      --card:#ffffff;

      /* 🔥 Merah premium */
      --accent-1: linear-gradient(135deg,#ef4444,#dc2626);
      --accent-2:#c81e1e;

      --muted:#6b7280;
      --radius:12px;
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }
    *{box-sizing:border-box}
    body{
      margin:0;min-height:100vh;
      background:radial-gradient(1200px 600px at 10% 10%,rgba(239,68,68,0.08),transparent), var(--bg);
      display:flex;align-items:center;justify-content:center;padding:32px
    }

    .card{
      width:100%;max-width:720px;background:var(--card);
      border-radius:var(--radius);
      box-shadow:0 10px 30px rgba(185,28,28,0.15);
      padding:36px;display:grid;
      grid-template-columns:120px 1fr;
      gap:20px;align-items:center;
      animation:fade .5s ease-out;
    }

    @keyframes fade{
      from{opacity:0;transform:translateY(8px)}
      to{opacity:1;transform:translateY(0)}
    }

    .illustration{
      display:flex;align-items:center;justify-content:center;height:100%;
    }

    .badge{
      width:96px;height:96px;border-radius:24px;
      display:grid;place-items:center;
      background:var(--accent-1);
      box-shadow:0 8px 20px rgba(185,28,28,0.32);
      transform:translateY(-6px);
      animation:pop .5s ease-out;
    }

    @keyframes pop{
      from{transform:translateY(8px) scale(.96);opacity:0}
      to{transform:translateY(0) scale(1);opacity:1}
    }

    .content h1{
      margin:0 0 8px 0;font-size:22px;
      color:#b91c1c;font-weight:700
    }

    .content p{
      margin:0 0 18px 0;color:var(--muted);
      line-height:1.6;font-size:15px
    }

    .actions{display:flex;gap:12px;flex-wrap:wrap;margin-top:10px}

    .btn{
      padding:10px 16px;border-radius:10px;border:0;
      cursor:pointer;font-weight:600;
      display:inline-flex;align-items:center;
      transition:.25s;font-size:14px;
    }

    .btn-primary{
      background:var(--accent-2);color:white;
      box-shadow:0 6px 18px rgba(185,28,28,0.25);
    }
    .btn-primary:hover{
      background:#991b1b;
    }

    .meta{
      margin-top:12px;font-size:13px;color:#9aa3b2
    }

    @media(max-width:560px){
      .card{
        grid-template-columns:1fr;text-align:center;padding:24px
      }
      .illustration{order:-1}
    }
  </style>
</head>

<body>

  <main class="card" role="main" aria-labelledby="title">

    <div class="illustration" aria-hidden="true">
      <div class="badge">
        <!-- Icon X -->
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
          <path d="M6 6l12 12M18 6L6 18"
                stroke="#fff" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
    </div>

    <div class="content">
      <h1 id="title">Data Anda Ditolak</h1>

      <p>Maaf, data pendaftaran yang Anda kirim tidak dapat kami proses.  
      Silakan periksa kembali data Anda dan lakukan pendaftaran ulang dengan informasi yang benar.</p>

      <div class="actions">
        <a href="/pendaftaran" class="btn btn-primary">Daftar Ulang</a>
      </div>

      <div class="meta">Jika merasa ini adalah kesalahan, silakan hubungi admin.</div>
    </div>

  </main>

</body>
</html>
