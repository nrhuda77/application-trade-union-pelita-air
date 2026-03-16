<!doctype html>
<html lang="id">
<head>
   <link rel="icon" type="image/x-icon" href="{{ asset('assets-admin/img/logo-srkt.png') }}" />

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login • Pelita Air</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* ============================
      PREMIUM LOGIN STYLE
   ============================ */
:root {
  --primary: #0f50b1;
  --accent: #ff4d4f;
  --soft: #7cc1ff;
  --bg: #eef3ff;
  --radius: 18px;
  --shadow: 0 15px 35px rgba(0,0,0,0.08);
  --shadow-hover: 0 20px 45px rgba(0,0,0,0.14);
}

body {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
    background: #eef5ff;
  font-family: Inter, system-ui, sans-serif;
  padding: 2rem;
   background-image:
      radial-gradient(circle at 20% 20%, rgba(0,150,255,0.15), transparent 60%),
      radial-gradient(circle at 80% 80%, rgba(0,255,200,0.12), transparent 70%);
}
.logo-header {
    width: 40px;
    height: auto !important;   /* penting: biar tidak lonjong */
    object-fit: contain;       /* jaga proporsi */
}

/* Di HP */
@media (max-width: 576px) {
    .logo-header {
        width: 45px;
        height: auto !important;
    }
}

/* CARD LOGIN */
.login-card {
  width: 100%;
  max-width: 900px;
  display: flex;
  border-radius: var(--radius);
  overflow: hidden;
  background: white;
  box-shadow: var(--shadow);
  animation: fadeIn 0.6s ease forwards;
  transition: .35s ease;
}

.login-card:hover {
  box-shadow: var(--shadow-hover);
  transform: translateY(-4px);
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

/* PANEL KIRI */
.brand-panel {
  flex: 1;
  color: white;
  padding: 2.5rem;
  display: flex;
  flex-direction: column;
  gap: 1rem;
  justify-content: center;
  background: linear-gradient(120deg, #0569ff, #c0d4ef, #535456);
  background-size: 320% 320%;
  animation: gradientMove 4s ease infinite;
}

@keyframes gradientMove {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

.brand-logo {
  display: flex;
  align-items: center;
  gap: .8rem;
  font-size: 1.4rem;
  font-weight: 700;
}

.brand-logo .mark {
  width: 55px;
  height: 55px;
  border-radius: 14px;
  background: rgba(255,255,255,0.25);
  display: flex;
  align-items: center;
  justify-content: center;
  backdrop-filter: blur(4px);
}

/* PANEL KANAN */
.form-panel {
  flex: 1;
  padding: 2.8rem;
  position: relative;
  background: #ffffff;
  box-shadow: 0 0 0 rgba(0,0,0,0);
  transition: .35s ease;
}

.form-panel:hover {
  transform: translateY(-3px);
}

.form-panel h4 {
  font-weight: 700;
  color: var(--primary);
  letter-spacing: .3px;
}

/* INPUT */
.input-group {
  background: #f4f6ff;
  border-radius: 14px;
  padding: 6px 10px;
  transition: .25s ease;
}

.input-group:hover {
  box-shadow: 0 5px 15px rgba(15,80,177,0.18);
  transform: translateY(-2px);
}

.input-group-text {
  background: none;
  border: none;
  color: var(--primary);
  font-size: 1.2rem;
}

.form-control {
  border: none;
  background: transparent;
  padding-left: 6px;
}

.form-control:focus {
  box-shadow: none;
  background: transparent;
}

/* BUTTON */
.btn-primary {
  background: var(--primary);
  border: none;
  font-weight: 600;
  border-radius: 14px;
  padding: 12px;
  letter-spacing: .4px;
  position: relative;
  overflow: hidden;
  transition: 0.3s;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(15,80,177,0.35);
}

/* Button Shine */
.btn-primary::after {
  content: "";
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(120deg, transparent, rgba(255,255,255,0.35), transparent);
  transition: .6s;
}
.btn-primary:hover::after {
  left: 100%;
}

/* Divider */
.divider {
  display: flex;
  align-items: center;
  text-align: center;
  margin: 20px 0;
}
.divider::before,
.divider::after {
  content: "";
  flex: 1;
  border-bottom: 1px solid #d0d7e5;
}
.divider span {
  padding: 0 12px;
  font-size: .85rem;
  color: #7a7a7a;
}

/* Links */
.auth-link {
  font-size: .9rem;
  color: var(--primary);
  text-decoration: none;
  padding: 8px 14px;
  border-radius: 10px;
  background: rgba(15,80,177,0.08);
  transition: .25s ease;
}
.auth-link:hover {
  background: rgba(15,80,177,0.15);
  transform: translateY(-2px);
}

.register-wrapper {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(15, 177, 145, 0.06);
    padding: 12px 18px;
    border-radius: 14px;
    border: 1px solid rgba(15, 177, 147, 0.15);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.05);
    transition: 0.3s ease;
}

.register-wrapper:hover {
    background: rgba(15,80,177,0.10);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.07);
}

.register-wrapper, .forgot-btn {
    will-change: transform;
}

.register-text {
    font-size: .9rem;
    color: #2c2c2c;
}

.register-btn-new {
    color: var(--primary);
    font-weight: 600;
    text-decoration: none;
    padding: 6px 10px;
    border-radius: 10px;
    background: rgba(15, 177, 169, 0.12);
    transition: .25s ease;
}

.register-btn-new:hover {
    background: var(--primary);
    color: white;
    padding: 6px 14px;
}

.forgot-btn {
   margin-bottom: 10px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 16px;
    font-size: .9rem;
    color: var(--primary);
    background: rgba(15,80,177,0.08);
    border-radius: 12px;
    text-decoration: none;
    transition: .3s ease;
    border: 1px solid rgba(15,80,177,0.15);
}

.forgot-btn:hover {
    background: rgba(15,80,177,0.15);
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(0,0,0,0.06);
}

</style>

</head>

<body>

<div class="login-card">


  <!-- PANEL KIRI -->
  <div class="brand-panel d-none d-lg-flex">

      <div class="brand-logo">
        <div class="mark">
          <img src="assets-admin/img/logo-srkt.png" width="40" alt="">
        </div>
        <div class="text-dark">
          SPPAS
          <div style="font-size:.85rem;opacity:.9" class="text-dark">Serikat Pekerja Pelita Air Service</div>
        </div>
      </div>

      <p class="text-dark" style="opacity:.95;line-height:1.45; font-size:1rem;">
        Akses masuk ke dashboard serta layanan internal Serikat Kerja Pelita Air dengan mudah dan aman.
      </p>
  </div>

  <!-- PANEL KANAN -->
  <div class="form-panel">
        @if (session('loginFailed'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('loginFailed') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
    <div class="d-flex justify-content-between">
          <h4 class="mb-1">Selamat Datang di SPPAS</h4>  
        <img  class="logo-header" src="assets-admin/img/logo-srkt.png"  alt="">
    </div>

    <small class="text-muted">Akses masuk ke akun internal Anda</small>

    <form class="mt-4" action="/login" method="POST">
      @csrf
      <div class="mb-3">
        <label class="form-label">Email / NIP</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-person"></i></span>
          <input type="text" name="username" class="form-control" placeholder="Masukkan email atau NIP Anda">
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Kata Sandi</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-lock"></i></span>
          <input type="password" name="password" class="form-control" placeholder="••••••••">
        </div>
      </div>

      <div class="d-grid mt-3">
        <button type="submit" class="btn btn-primary btn-lg">Masuk</button>
      </div>

      <div class="auth-links text-center mt-4">
        <div class="divider">
          <span>Atau</span>
        </div>

      <a href="/forgot-password/verif-email" class="forgot-btn">
    <i class="bi bi-question-circle"></i> Lupa Kata Sandi?
</a>


        <div class="register-box mt-4">
    <div class="register-wrapper">
        <span class="register-text">Belum memiliki akun?</span>
        <a href="/pendaftaran" class="register-btn-new">Daftar Sekarang</a>
    </div>
</div>

      </div>
    </form>

    <div class="text-center mt-4 small text-muted">
      © 2025 Serikat Kerja Pelita Air
    </div>
  </div>

</div>

</body>
</html>
