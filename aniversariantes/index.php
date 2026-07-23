<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Aniversariantes - DOREMI</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f8fafc; font-family: Inter, sans-serif; }
    .sidebar { width: 280px; background: linear-gradient(180deg, #1d4ed8, #2563eb); color: white; min-height: 100vh; padding: 24px 18px; }
    .content { flex: 1; padding: 28px; }
    .school-logo { width: 120px; border-radius: 16px; background: white; padding: 8px; }
    .sidebar-title { font-size: 1.1rem; font-weight: 700; }
    .sidebar-subtitle { opacity: 0.9; font-size: 0.95rem; }
    .sidebar-divider { border-top: 1px solid rgba(255,255,255,0.25); margin: 18px 0; }
    .back-button { display: inline-block; color: #1d4ed8; font-weight: 700; text-decoration: none; margin-bottom: 16px; }
    .card { border: none; border-radius: 18px; box-shadow: 0 8px 24px rgba(15,23,42,0.06); }
    .student-photo { width: 100%; height: 220px; object-fit: cover; object-position: center; }
    .badge-pill { border-radius: 999px; padding: 6px 10px; font-size: 0.8rem; }
  </style>
</head>
<body>
  <div class="d-flex">
    <div class="sidebar">
      <div class="text-center mb-4">
        <img src="https://vpn.doremieducacao.com.br/familiadoremi/img/logo_white.jpg" class="school-logo mb-3" alt="DOREMI">
        <h4 class="sidebar-title mb-0">Instituto Educacional</h4>
        <div class="sidebar-subtitle">DOREMI</div>
      </div>
      <div class="sidebar-divider"></div>
      <div class="text-uppercase small fw-bold opacity-75 mb-2">Mês</div>
      <select id="monthSelect" class="form-select">
        <option value="1">Janeiro</option>
        <option value="2">Fevereiro</option>
        <option value="3">Março</option>
        <option value="4">Abril</option>
        <option value="5">Maio</option>
        <option value="6">Junho</option>
        <option value="7">Julho</option>
        <option value="8">Agosto</option>
        <option value="9">Setembro</option>
        <option value="10">Outubro</option>
        <option value="11">Novembro</option>
        <option value="12">Dezembro</option>
      </select>
    </div>

    <div class="content">
      <a href="/totemdoremi/menu" class="back-button">← Voltar ao Menu</a>
      <h2 id="monthTitle" class="mb-4">Aniversariantes</h2>
      <div id="studentsContainer" class="row g-4"></div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="aniversariantes.js"></script>
</body>
</html>
