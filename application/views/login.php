<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | E-BK SMA NEGERI 1 PRESTASI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #fd7e14 0%, #e86b00 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }
        .login-card img {
            width: 80px;
            margin-bottom: 20px;
        }
        .btn-login {
            background-color: #fd7e14;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-login:hover {
            background-color: #e86b00;
            color: white;
        }
        .form-control {
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>

<div class="login-card text-center">
    <img src="https://ui-avatars.com/api/?name=SIAKAD&background=fd7e14&color=fff" alt="Logo">
    <h4 class="fw-bold mb-1">E-BK SMAN 1</h4>
    <p class="text-muted mb-4 small">Silakan login untuk mengelola data sekolah</p>

    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger py-2 small"><?= $this->session->flashdata('error'); ?></div>
    <?php endif; ?>

    <?= form_open('auth'); ?>
        <div class="mb-3 text-start">
            <label class="form-label small fw-bold">Username</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-0"><i class="fas fa-user text-muted"></i></span>
                <input type="text" name="username" class="form-control bg-light border-0" placeholder="Username Anda" required>
            </div>
        </div>
        <div class="mb-4 text-start">
            <label class="form-label small fw-bold">Kata Sandi</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-0"><i class="fas fa-lock text-muted"></i></span>
                <input type="password" name="password" class="form-control bg-light border-0" placeholder="********" required>
            </div>
        </div>
        <button type="submit" class="btn btn-login w-100 shadow">Masuk Sekarang</button>
    <?= form_close(); ?>

    <p class="mt-4 text-muted small">&copy; 2026 SMA Negeri 1 Prestasi</p>
</div>

</body>
</html>
