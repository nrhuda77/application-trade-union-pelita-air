<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Email Berhasil Dikirim</title>
  <style>
    :root{
      --bg:#f5f7fb;
      --card:#ffffff;
      --accent-1: linear-gradient(135deg,#2dd4bf,#06b6d4);
      --accent-2: #0ea5e9;
      --muted:#6b7280;
      --radius:12px;
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }
    *{box-sizing:border-box}
    body{margin:0;min-height:100vh;background:radial-gradient(1200px 600px at 10% 10%,rgba(14,165,233,0.06),transparent), var(--bg);display:flex;align-items:center;justify-content:center;padding:32px}

    .card{
      width:100%;max-width:720px;background:var(--card);border-radius:var(--radius);box-shadow:0 10px 30px rgba(2,6,23,0.08);padding:36px;display:grid;grid-template-columns:120px 1fr;gap:20px;align-items:center;
    }

    .illustration{display:flex;align-items:center;justify-content:center;height:100%;}
    .badge{
      width:96px;height:96px;border-radius:24px;display:grid;place-items:center;background:var(--accent-1);box-shadow:0 8px 20px rgba(6,182,212,0.18);transform:translateY(-6px);animation:pop .5s ease-out;
    }
    @keyframes pop{from{transform:translateY(8px) scale(.96);opacity:0}to{transform:translateY(0) scale(1);opacity:1}}

    .content h1{margin:0 0 8px 0;font-size:20px;color:#05263b}
    .content p{margin:0 0 18px 0;color:var(--muted);line-height:1.5}

    .actions{display:flex;gap:12px;flex-wrap:wrap}
    .btn{
      display:inline-flex;align-items:center;gap:10px;padding:10px 16px;border-radius:10px;border:0;cursor:pointer;font-weight:600}
    .btn-primary{background:var(--accent-2);color:white;box-shadow:0 6px 18px rgba(14,165,233,0.18)}
    .btn-ghost{background:transparent;border:1px solid #e6eef9;color:var(--accent-2)}

    .meta{margin-top:12px;font-size:13px;color:#9aa3b2}

    /* responsive */
    @media (max-width:560px){
      .card{grid-template-columns:1fr;text-align:center;padding:24px}
      .illustration{order:-1}
    }
    
    .spinner {
    width: 16px;
    height: 16px;
    border: 2px solid transparent;
    border-top: 2px solid #333;
    border-radius: 50%;
    margin-right: 8px;
    animation: spin 0.8s linear infinite;
    display: none;
}

.btn.loading .spinner {
    display: inline-block;
}

.btn.loading .btn-text {
    opacity: 0.5;
}

/* Animasi loading */
@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}
  </style>
      <link rel="icon" href="https://sppelitaair.org/template/landing/assets/img/logo-srkt.png" type="image/png">
</head>
<body>
  <main class="card" role="main" aria-labelledby="title">
    <div class="illustration" aria-hidden="true">
      <div class="badge">
        <!-- check icon -->
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden>
          <path d="M20 6L9 17l-5-5" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
    </div>

    <div class="content">
      <h1 id="title">Email Berhasil Dikirim</h1>
      <p>Terima kasih — email konfirmasi telah dikirim. Silakan periksa inbox atau folder spam pada alamat email yang kamu daftarkan. Jika tidak muncul dalam beberapa menit, coba muat ulang atau gunakan fitur kirim ulang.</p>

      <div class="actions">
<form method="POST" action="/forgot-password/send-verif-email">
    @csrf
        <input type="hidden" name="email" value="{{$email}}">
    <button type="submit" class="btn btn-ghost" id="submit-btn">
    
        <span class="spinner" aria-hidden="true"></span>
        <span class="btn-text">Kirim Ulang</span>
    </button>
</form>

      </div>

      <div class="meta">Butuh bantuan? Hubungi kami di <strong>support@koperasi.example</strong> atau via WhatsApp.</div>
    </div>
  </main>

  <script>
    // small accessibility enhancement: focus tombol pertama
    document.querySelector('.btn-primary').focus();
  </script>
</body>
</html>