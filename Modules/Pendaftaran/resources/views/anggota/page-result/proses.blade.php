<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Email Berhasil Dikirim</title>

  <style>
    :root {
      --blue-1:#1e88ff;
      --blue-2:#3fa9ff;
      --blue-dark:#0b2b4a;

      --bg: #f2f6ff;
      --card-bg: rgba(255,255,255,0.82);

      --muted:#6c7688;
      --radius:20px;

      --shadow-1:0 16px 40px rgba(30,88,170,0.16);
      --shadow-2:0 0 90px rgba(30,136,255,0.25);

      font-family: "Inter", sans-serif;
    }

    body {
      margin: 0;
      min-height: 100vh;
      background:
        radial-gradient(1000px 600px at 15% 20%, rgba(30,136,255,0.09), transparent),
        var(--bg);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 32px;
    }

    /* CARD */
    .card {
      width: 100%;
      max-width: 760px;
      backdrop-filter: blur(14px);
      background: var(--card-bg);
      border-radius: var(--radius);
      padding: 46px 40px;
      display: grid;
      grid-template-columns: 130px 1fr;
      gap: 30px;
      box-shadow: var(--shadow-1);
      animation: fadeIn .55s ease;
      position: relative;
      overflow: hidden;
    }

    /* Decorative gradient glow */
    .glow {
      position:absolute;
      width:220px;
      height:220px;
      background: radial-gradient(circle, rgba(63,169,255,0.45), transparent 70%);
      top:-40px;
      left:-40px;
      filter:blur(12px);
      animation: pulse 6s infinite ease-in-out;
    }

    @keyframes pulse {
      0% { transform:scale(1); opacity:.55; }
      50% { transform:scale(1.2); opacity:.35; }
      100% { transform:scale(1); opacity:.55; }
    }

    /* BADGE ICON */
    .badge {
      width: 105px;
      height: 105px;
      border-radius: 26px;
      display: grid;
      place-items: center;
      background: linear-gradient(135deg, var(--blue-2), var(--blue-1));
      box-shadow:
        0 12px 25px rgba(30,136,255,0.25),
        inset 0 0 22px rgba(255,255,255,0.2);
      animation: pop .55s ease-out;
    }

    @keyframes pop {
      0% { transform:scale(.7); opacity:0; }
      100% { transform:scale(1); opacity:1; }
    }

    /* CONTENT */
    h1 {
      margin: 0 0 12px 0;
      font-size: 26px;
      font-weight: 700;
      color: var(--blue-dark);
    }

    .lead {
      font-size: 15px;
      color: var(--muted);
      line-height: 1.6;
      margin-bottom: 22px;
    }

    /* DIVIDER LINE */
    .divider {
      height: 1px;
      background: linear-gradient(to right, transparent, #d7e5ff, transparent);
      margin: 18px 0;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 12px 20px;
      border-radius: 12px;
      font-weight: 600;
      cursor: pointer;
      font-size: 15px;
      border: 0;
    }

    .btn-ghost {
      background: rgba(255,255,255,0.4);
      border: 1px solid #c7dbff;
      color: var(--blue-1);
      backdrop-filter: blur(6px);
      transition: .25s;
    }
    .btn-ghost:hover {
      background: #eaf2ff;
    }

    .meta {
      margin-top: 14px;
      font-size: 13px;
      color: #7c8798;
    }

    /* LOADING */
    .spinner {
      width: 16px;
      height: 16px;
      border: 2px solid transparent;
      border-top: 2px solid white;
      border-radius: 50%;
      animation: spin 0.8s linear infinite;
      display: none;
    }
    .btn.loading .spinner { display: inline-block; }
    .btn.loading .btn-text { opacity:.55; }

    @keyframes spin { to { transform: rotate(360deg); } }

    /* responsive */
    @media(max-width:560px){
      .card {
        grid-template-columns: 1fr;
        text-align:center;
        padding: 34px;
      }
      .badge {
        margin: 0 auto;
      }
    }
  </style>

  <link rel="icon" href="https://sppelitaair.org/template/landing/assets/img/logo-srkt.png" type="image/png">
</head>

<body>

  <main class="card">

    <div class="glow"></div>

    <!-- ICON -->
    <div class="badge">
      <svg width="52" height="52" viewBox="0 0 24 24" fill="none">
        <path d="M20 6L9 17l-5-5" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>

    <!-- TEXT CONTENT -->
    <div class="content">
      <h1>Email Berhasil Dikirim</h1>

      <p class="lead">
        Terima kasih! Tautan verifikasi sudah kami kirimkan.
        Silakan cek inbox atau folder spam pada email Anda.
      </p>

      <div class="divider"></div>
 
 

        <button type="submit" class="btn btn-ghost" id="btnKirimUlang">
          <span class="spinner"></span>
          <span class="btn-text">Kirim Ulang Email</span>
        </button>
 

      {{-- <div class="meta">
        Jika membutuhkan bantuan, hubungi kami di
        <strong>support@koperasi.example</strong>
      </div> --}}
    </div>

  </main>

<script>
document.getElementById('btnKirimUlang').addEventListener('click', function () {
    let email = "{{ $email }}";
    let uuid  = "{{ $uuid }}";

    let url = `https://sppelitaair.org/send-ulang-email-pendaftaran/${email}/${uuid}`;

    let btn = this;
    btn.disabled = true;
    btn.innerText = "Mengirim...";

    fetch(url)
        .then(res => res.json())
        .then(data => {
            document.getElementById('statusMessage').innerHTML = `
                <div style="padding:10px; border-radius:6px; background:#e7f7e7; color:#2c7a2c;">
                    ✔ Email verifikasi berhasil dikirim ulang!
                </div>
            `;
        })
        .catch(err => {
            document.getElementById('statusMessage').innerHTML = `
                <div style="padding:10px; border-radius:6px; background:#fdeaea; color:#c62828;">
                    ✖ Gagal mengirim email. Coba lagi.
                </div>
            `;
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerText = "Kirim Ulang Email Verifikasi";
        });
});
</script>


</body>
</html>
