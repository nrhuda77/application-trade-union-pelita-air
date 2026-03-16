<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login • SPPAS</title>
 <link rel="icon" type="image/x-icon" href="{{ asset('assets-admin/img/logo-srkt.png') }}" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
  body {
    font-family: Inter, system-ui;
    background: #eef5ff;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;

    background-image:
      radial-gradient(circle at 20% 20%, rgba(0,150,255,0.15), transparent 60%),
      radial-gradient(circle at 80% 80%, rgba(0,255,200,0.12), transparent 70%);
  }

  .login-box {
    width: 100%;
    max-width: 420px;
    padding: 40px 35px;
    border-radius: 20px;
    background: #ffffff;
    backdrop-filter: blur(10px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.1);
    border: 1px solid rgba(0,0,0,0.06);
    position: relative;
    overflow: hidden;
  }

  /* BORDER ANIMATED LIGHT */
  .login-box::before {
    content: "";
    position: absolute;
    inset: 0;
    border-radius: 20px;
    padding: 1px;
    background: linear-gradient(130deg, #00b2ff, #00ffd7, #008cff);
    background-size: 300% 300%;
    animation: glowBorder 5s ease infinite;

    -webkit-mask: 
      linear-gradient(#000 0 0) content-box, 
      linear-gradient(#000 0 0);
    -webkit-mask-composite: xor;
            mask-composite: exclude;

    opacity: .45;
    pointer-events: none;
  }

  @keyframes glowBorder {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }

  .logo-area {
    text-align: center;
    margin-bottom: 15px;
  }
  .logo-area img {
    width: 70px;
  }

  .title {
    text-align: center;
    color: #0b2c5f;
    font-weight: 700;
    font-size: 1.3rem;
  }

  .subtitle {
    text-align: center;
    color: #4d6280;
    font-size: .9rem;
    margin-bottom: 25px;
  }

  .admin-badge {
    background: rgba(0,180,255,0.15);
    padding: 5px 12px;
    border-radius: 8px;
    font-size: .75rem;
    color: #007b9f;
    font-weight: 600;
    display: inline-block;
    margin-bottom: 15px;
  }

  .input-group {
    background: rgba(0,0,0,0.04);
    border-radius: 12px;
    border: 1px solid rgba(0,0,0,0.15);
    transition: .25s;
  }
  .input-group:hover {
    border-color: #00b7ff;
    box-shadow: 0 0 12px rgba(0,180,255,0.25);
  }

  .input-group-text {
    background: transparent;
    border: none;
    color: #009fd9;
    font-size: 1.2rem;
  }

  .form-control {
    background: transparent;
    border: none;
    color: #0d233d;
  }

  .form-control:focus {
    box-shadow: none;
    background: transparent;
    color: #0d233d;
  }

  .btn-login {
    width: 100%;
    padding: 12px;
    font-weight: 600;
    border-radius: 12px;
    border: none;
    margin-top: 5px;
    background: linear-gradient(120deg,#00b7ff,#00ffe2);
    color: #003048;
    transition: .3s;
  }
  .btn-login:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 22px rgba(0,200,255,0.3);
  }

  .footer {
    text-align: center;
    margin-top: 25px;
    color: #506079;
    font-size: .8rem;
  }
</style>
</head>

<body>

<div class="login-box">

  <div class="logo-area">
    <img src="assets-admin/img/logo-srkt.png">
  </div>

  <div class="title">SPPAS Admin Login</div>
  <div class="subtitle">Akses Khusus Administrator</div>

  <div class="text-center mb-3">
    <span class="admin-badge">
      <i class="bi bi-shield-lock"></i> Admin Panel
    </span>
  </div>

  <form action="/login-admin" method="POST">
    @csrf

    <div class="mb-3">
      <label class="text-dark mb-1">Email</label>
      <div class="input-group">
        <span class="input-group-text"><i class="bi bi-person"></i></span>
        <input type="text" name="email" class="form-control" placeholder="ketik di sini...">
      </div>
    </div>

    <div class="mb-3">
      <label class="text-dark mb-1">Password</label>
      <div class="input-group">
        <span class="input-group-text"><i class="bi bi-lock"></i></span>
        <input type="password" id="passwordField" name="password" class="form-control" placeholder="********">

        <span class="input-group-text password-toggle" onclick="togglePassword()" style="cursor:pointer;">
          <i id="toggleIcon" class="bi bi-eye-slash"></i>
        </span>
      </div>
    </div>

    <button type="submit" class="btn-login">Masuk</button>

  </form>

  <div class="footer">
    © 2025 SPPAS • Pelita Air
  </div>

</div>

<script>
function togglePassword() {
  const field = document.getElementById("passwordField");
  const icon  = document.getElementById("toggleIcon");

  if (field.type === "password") {
    field.type = "text";
    icon.classList.remove("bi-eye-slash");
    icon.classList.add("bi-eye");
  } else {
    field.type = "password";
    icon.classList.remove("bi-eye");
    icon.classList.add("bi-eye-slash");
  }
}
</script>

</body>
</html>
