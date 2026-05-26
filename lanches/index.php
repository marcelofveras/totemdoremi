<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Lanches do Dia - DOREMI
    </title>

    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- CSS -->

    <link
        href="custom.css"
        rel="stylesheet"
    >

</head>

<body>

    <!-- =====================================
         SIDEBAR
    ====================================== -->

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

            Período

        </div>

        <div
            class="nav flex-column nav-pills"
            id="periodMenu"
        >

            <button
                class="nav-link active"
                onclick="loadPeriodo('Manhã', this)"
            >
                ☀️ Manhã
            </button>

            <button
                class="nav-link"
                onclick="loadPeriodo('Tarde', this)"
            >
                🌙 Tarde
            </button>

        </div>

    </div>

    <!-- =====================================
         CONTENT
    ====================================== -->

    <div class="content">

        <div
            class="
                d-flex
                justify-content-between
                align-items-center
                mb-4
            "
        >
<div class="mb-4">

    <a
        href="/menu"
        class="back-button"
    >
        ← Voltar ao Menu
    </a>

</div>

            <h2 id="periodTitle">

                Lanches da Manhã

            </h2>

        </div>

        <!-- CARDS -->

        <div
            class="row g-4"
            id="studentsContainer"
        >

        </div>

    </div>

    <!-- =====================================
         JS
    ====================================== -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>

    <script src="lanches.js"></script>

</body>

</html>