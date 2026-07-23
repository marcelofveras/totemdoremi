<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Instituto Educacional DOREMI</title>

  <!-- Bootstrap 5 -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="custom.css" rel="stylesheet">
  <style>

  </style>
</head>
<body>

<div class="sidebar">

  <div class="text-center px-3 mb-4">

    <img
      src="https://vpn.doremieducacao.com.br/familiadoremi/img/logo_white.jpg"
      class="school-logo mb-3"
      alt="DOREMI"
    >

    <h4 class="sidebar-title mb-0">
      Instituto Educacional
    </h4>

    <div class="sidebar-subtitle">
      DOREMI
    </div>

  </div>

  <div class="sidebar-divider"></div>

  <div class="sidebar-section-title px-4 mb-3">
    Turmas
  </div>

  <div class="nav flex-column nav-pills" id="classMenu">

    <button class="nav-link active"
            onclick="loadClass('Berçário 1', this)">
      Berçário 1
    </button>

    <button class="nav-link"
            onclick="loadClass('Berçário 2', this)">
      Berçário 2
    </button>

    <button class="nav-link"
            onclick="loadClass('Maternal 1', this)">
      Maternal 1
    </button>

    <button class="nav-link"
            onclick="loadClass('Maternal 2', this)">
      Maternal 2
    </button>

    <button class="nav-link"
            onclick="loadClass('Infantil 1', this)">
      Infantil 1
    </button>

    <button class="nav-link"
            onclick="loadClass('Infantil 2', this)">
      Infantil 2
    </button>

    <button class="nav-link"
            onclick="loadClass('1º Ano', this)">
      1º Ano
    </button>

  </div>

</div>

  <!-- Conteúdo -->
  <div class="content">
  
  <div class="mb-4">

    <a
        href="/totemdoremi/menu"
        class="back-button"
    >
        ← Voltar ao Menu
    </a>

</div>

    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 id="classTitle">Berçário 1</h2>
    </div>

    <div class="row g-4" id="studentsContainer"></div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="studentModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Detalhes do Aluno</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

          <!-- Aluno -->
          <div class="row align-items-center mb-4">
            <div class="col-md-3 text-center">
              <img id="modalStudentPhoto" class="student-modal-photo">
            </div>

            <div class="col-md-9">
              <h3 id="modalStudentName"></h3>
              <p class="text-muted mb-0">Informações completas do aluno</p>
            </div>
          </div>

          <hr>

          <!-- Pais -->
          <div class="mb-4">
            <div class="section-title">Pais / Responsáveis</div>

            <div class="row g-4" id="parentsContainer"></div>
          </div>

          <!-- Autorizados -->
          <div>
            <div class="section-title">
              Pessoas autorizadas para retirada
            </div>

            <div class="row g-4" id="authorizedContainer"></div>
          </div>

        </div>

      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="ficha.js"></script>
</body>
</html>