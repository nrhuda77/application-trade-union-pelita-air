<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Password Berhasil Diubah</title>
  <style>
    :root{
      --bg:#f4f7fb;
      --card:#ffffff;
      --accent: linear-gradient(135deg,#7c3aed,#06b6d4);
      --muted:#6b7280;
      --radius:14px;
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }
    *{box-sizing:border-box}
    body{margin:0;min-height:100vh;background:radial-gradient(900px 400px at 90% 10%,rgba(99,102,241,0.05),transparent), var(--bg);display:flex;align-items:center;justify-content:center;padding:28px}

    .card{width:100%;max-width:720px;background:var(--card);border-radius:var(--radius);box-shadow:0 12px 30px rgba(2,6,23,0.06);padding:34px;display:grid;grid-template-columns:120px 1fr;gap:20px;align-items:center}
    .illustration{display:flex;align-items:center;justify-content:center}
    .badge{width:96px;height:96px;border-radius:22px;display:grid;place-items:center;background:var(--accent);box-shadow:0 8px 24px rgba(59,130,246,0.12);transform:translateY(-6px);}

    .content h1{margin:0 0 6px 0;font-size:20px;color:#0f172a}
    .content p{margin:0 0 16px 0;color:var(--muted);line-height:1.5}

    .actions{display:flex;gap:12px;flex-wrap:wrap}
    .btn{display:inline-flex;align-items:center;gap:10px;padding:10px 16px;border-radius:10px;border:0;cursor:pointer;font-weight:600}
    .btn-primary{background:#7c3aed;color:white;box-shadow:0 6px 18px rgba(124,58,237,0.16)}
    .btn-ghost{background:transparent;border:1px solid #eef2ff;color:#4c1d95}

    .meta{margin-top:12px;font-size:13px;color:#9aa3b2}

    @media (max-width:560px){.card{grid-template-columns:1fr;text-align:center}}
  </style>
      <link rel="icon" href="https://sppelitaair.org/template/landing/assets/img/logo-srkt.png" type="image/png">
</head>
<body>
  <main class="card" role="main" aria-labelledby="title">
    <div class="illustration" aria-hidden="true">
      <div class="badge" aria-hidden>
        <!-- lock icon -->
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <rect x="3" y="11" width="18" height="10" rx="2" stroke="white" stroke-width="1.6"/>
          <path d="M7 11V8a5 5 0 0110 0v3" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
    </div>

    <div class="content">
      <h1 id="title">Password Berhasil Diubah</h1>
      <p>Password akun Anda telah berhasil diperbarui. Jika Anda tidak melakukan perubahan ini, segera hubungi tim dukungan atau gunakan fitur reset password untuk mengamankan akun Anda.</p>

      <div class="actions">
        <a class="btn btn-primary" href="https://sppelitaair.org/login">Kembali ke Halaman Login</a>

      </div>

      <div class="meta">Butuh bantuan? Hubungi support di <strong>support@koperasi.example</strong>.</div>
    </div>
  </main>
</body>
</html>
