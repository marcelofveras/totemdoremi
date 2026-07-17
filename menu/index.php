<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Painel DOREMI
    </title>

    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body{

            margin:0;

            min-height:100vh;

            display:flex;

            align-items:center;

            justify-content:center;

            background:linear-gradient(
                180deg,
                #eef2ff 0%,
                #f8fafc 100%
            );

            font-family:Inter, sans-serif;
        }

        .main-container{

            width:100%;

            max-width:1200px;

            padding:40px;
        }

        .logo{

            width:180px;

            border-radius:24px;

            background:white;

            padding:14px;

            box-shadow:0 12px 30px rgba(0,0,0,0.08);
        }

        .title{

            font-size:2.6rem;

            font-weight:800;

            color:#0f172a;
        }

        .subtitle{

            color:#64748b;

            font-size:1.1rem;
        }

        .menu-card{

            border:none;

            border-radius:28px;

            overflow:hidden;

            transition:0.25s;

            background:white;

            height:100%;

            text-decoration:none;

            box-shadow:0 10px 30px rgba(15,23,42,0.08);
        }

        .menu-card:hover{

            transform:translateY(-8px);

            box-shadow:0 20px 40px rgba(15,23,42,0.14);
        }

        .menu-card-body{

            padding:38px;
        }

        .menu-icon{

            font-size:3rem;

            margin-bottom:18px;
        }

        .menu-title{

            font-size:1.4rem;

            font-weight:800;

            color:#111827;

            margin-bottom:12px;
        }

        .menu-description{

            color:#64748b;

            line-height:1.6;
        }

        @media(max-width:768px){

            .main-container{

                padding:20px;
            }

            .title{

                font-size:2rem;
            }

            .menu-card-body{

                padding:28px;
            }
        }

    </style>

</head>

<body>

    <div class="main-container">

        <div class="text-center mb-5">

            <img
                src="https://vpn.doremieducacao.com.br/familiadoremi/img/logo_white.jpg"
                class="logo mb-4"
                alt="DOREMI"
            >

            <div class="title">
                Painel Institucional
            </div>

            <div class="subtitle mt-2">
                Consultas rápidas para funcionários
            </div>

        </div>

        <div class="row g-4">

            <!-- FICHAS -->

            <div class="col-md-4">

                <a
                    href="/totemdoremi/fichas"
                    class="menu-card d-block"
                >

                    <div class="menu-card-body text-center">

                        <div class="menu-icon">
                            👨‍🎓
                        </div>

                        <div class="menu-title">
                            Fichas dos Alunos
                        </div>

                        <div class="menu-description">

                            Consulte responsáveis,
                            autorizados e informações
                            completas dos alunos.

                        </div>

                    </div>

                </a>

            </div>

            <!-- CURSOS -->

            <div class="col-md-4">

                <a
                    href="/totemdoremi/cursosextra"
                    class="menu-card d-block"
                >

                    <div class="menu-card-body text-center">

                        <div class="menu-icon">
                            🎵
                        </div>

                        <div class="menu-title">
                            Cursos Extra Curriculares
                        </div>

                        <div class="menu-description">

                            Consulte os alunos
                            matriculados nos cursos
                            extracurriculares.

                        </div>

                    </div>

                </a>

            </div>

            <!-- LANCHES -->

            <div class="col-md-4">

                <a
                    href="/totemdoremi/lanches"
                    class="menu-card d-block"
                >

                    <div class="menu-card-body text-center">

                        <div class="menu-icon">
                            🍔
                        </div>

                        <div class="menu-title">
                            Lanches do Dia
                        </div>

                        <div class="menu-description">

                            Veja rapidamente quais
                            alunos compraram lanche
                            hoje.

                        </div>

                    </div>

                </a>

            </div>

        </div>

    </div>

</body>

</html>