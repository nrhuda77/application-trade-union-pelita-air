<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Status Akun • Menunggu Proses Admin</title>

  <style>
    :root{
      --bg:#f5f7fb;
      --card:#ffffff;

      /* 🔥 Kuning premium */
      --accent-1: linear-gradient(135deg,#facc15,#eab308);
      --accent-2:#d4a107;

      --muted:#6b7280;
      --radius:12px;
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }
    *{box-sizing:border-box}
    body{
      margin:0;min-height:100vh;
      background:radial-gradient(1200px 600px at 10% 10%,rgba(250,204,21,0.08),transparent), var(--bg);
      display:flex;align-items:center;justify-content:center;padding:32px
    }

    .card{
      width:100%;max-width:720px;background:var(--card);
      border-radius:var(--radius);
      box-shadow:0 10px 30px rgba(0,0,0,0.07);
      padding:36px;display:grid;
      grid-template-columns:120px 1fr;
      gap:20px;align-items:center;
      animation:fade .5s ease-out;
    }

    @keyframes fade {
      from{opacity:0; transform:translateY(8px)}
      to{opacity:1; transform:translateY(0)}
    }

    .illustration{display:flex;align-items:center;justify-content:center;height:100%;}

    .badge{
      width:96px;height:96px;border-radius:24px;
      display:grid;place-items:center;
      background:var(--accent-1);
      box-shadow:0 8px 20px rgba(220,177,32,0.28);
      transform:translateY(-6px);
      animation:pop .5s ease-out;
    }

    @keyframes pop{
      from{transform:translateY(8px) scale(.96);opacity:0}
      to{transform:translateY(0) scale(1);opacity:1}
    }

    .content h1{margin:0 0 8px 0;font-size:22px;color:#3b3b3b}
    .content p{margin:0 0 18px 0;color:var(--muted);line-height:1.6}

    .actions{margin-top:10px;display:flex;gap:12px;flex-wrap:wrap}

    .btn{
      display:inline-flex;align-items:center;gap:10px;
      padding:10px 16px;border-radius:10px;border:0;
      cursor:pointer;font-weight:600;
      transition:0.25s;
    }

    .btn-primary{
      background:var(--accent-2);color:white;
      box-shadow:0 6px 18px rgba(212,161,7,0.18);
    }
    .btn-primary:hover{
      background:#b38705;
    }

    .meta{margin-top:12px;font-size:13px;color:#9aa3b2}

    /* Spinner */
    .spinner{
      width:16px;height:16px;
      border:2px solid transparent;
      border-top:2px solid white;
      border-radius:50%;
      animation:spin .8s linear infinite;
      display:none;
    }

    .btn.loading .spinner{
      display:inline-block;
    }

    .btn.loading .btn-text{
      opacity:.5;
    }

    @keyframes spin{to{transform:rotate(360deg)}}

    /* responsive */
    @media(max-width:560px){
      .card{grid-template-columns:1fr;text-align:center;padding:24px}
      .illustration{order:-1}
    }
  </style>

</head>

<body>

  <main class="card" role="main" aria-labelledby="title">

    <div class="illustration" aria-hidden="true">
      <div class="badge">
        <!-- ikon jam / loading -->
        <svg width="48" height="48" fill="none" viewBox="0 0 24 24">
          <path d="M12 6v6l4 2" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
          <circle cx="12" cy="12" r="9" stroke="#fff" stroke-width="2.5"/>
        </svg>
      </div>
    </div>

    <div class="content">
      <h1 id="title">Menunggu Proses Admin</h1>

      <p>Data pendaftaran Anda sudah kami terima.  
      Mohon menunggu hingga admin memverifikasi data Anda.  
      Notifikasi akan dikirim ke email Anda.</p>

      <div class="actions">
        <button class="btn btn-primary" id="btn-resend">
          <span class="spinner"></span>
          <span class="btn-text">Kirim Ulang Email Verifikasi</span>
        </button>
      </div>

      <div id="result" class="meta"></div>
    </div>

  </main>

<script>
document.getElementById("btn-resend").addEventListener("click", function(){

    let email = "{{$email}}";
    let uuid  = "{{$uuid}}";

    let url = `https://sppelitaair.org/send-email-pendaftaran/${email}/${uuid}`;

    let btn = this;
    btn.classList.add("loading");

    fetch(url)
      .then(r => r.json())
      .then(res => {
        document.getElementById("result").innerHTML =
          "<span style='color:#b38705;'>✔ Email verifikasi berhasil dikirim ulang.</span>";
      })
      .catch(() => {
        document.getElementById("result").innerHTML =
          "<span style='color:#c62828;'>✖ Gagal mengirim email. Coba lagi.</span>";
      })
      .finally(() => {
        btn.classList.remove("loading");
      });

});
</script>

</body>
</html>
