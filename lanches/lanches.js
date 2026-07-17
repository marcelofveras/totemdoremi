const studentsContainer =
    document.getElementById('studentsContainer');


// ========================================
// CARREGAR PERÍODO
// ========================================

async function loadPeriodo(
    periodo,
    element
){

    document.getElementById('periodTitle')
        .innerText =
            'Lanches da ' + periodo;

    // ativa botão

    document.querySelectorAll('#periodMenu .nav-link')
        .forEach(btn=>btn.classList.remove('active'));

    element.classList.add('active');

    // loading

    studentsContainer.innerHTML = `
        <div class="col-12">

            <div class="text-center p-5">

                <div class="spinner-border"></div>

            </div>

        </div>
    `;

    try {

const response = await fetch(
    '../api/lanches.php?periodo='
    + encodeURIComponent(periodo)
);

        const alunos = await response.json();

        studentsContainer.innerHTML = '';

        // vazio

        if(!alunos || alunos.length === 0){

            studentsContainer.innerHTML = `
                <div class="col-12">

                    <div class="alert alert-secondary">

                        Nenhum aluno comprou
                        lanche neste período.

                    </div>

                </div>
            `;

            return;
        }

        // cards

        alunos.forEach(aluno=>{

            studentsContainer.innerHTML += `
                <div class="col-md-4 col-lg-3">

                    <div class="card student-card h-100">

                        <img
                            src="
https://vpn.doremieducacao.com.br/familiadoremi/img/fotos/${aluno.cpf}.bmp
                            "

                            class="card-img-top student-photo"

                            onerror="
                                this.src='img/user.png'
                            "
                        >

                        <div class="card-body text-center">

                            <h5 class="card-title mb-2">

                                ${aluno.nome}

                            </h5>

                            <div class="text-muted small">

                                ${aluno.turma}

                            </div>

                            <div class="snack-badge mt-3">

                                🍔 ${aluno.Lanche}

                            </div>

                        </div>

                    </div>

                </div>
            `;
        });

    } catch(error){

        console.error(error);

        studentsContainer.innerHTML = `
            <div class="col-12">

                <div class="alert alert-danger">

                    Erro ao carregar lanches.

                </div>

            </div>
        `;
    }
}


// ========================================
// INICIALIZAÇÃO
// ========================================

window.addEventListener(
    'DOMContentLoaded',
    ()=>{

        loadPeriodo(
            'Manhã',
            document.querySelector(
                '#periodMenu .nav-link.active'
            )
        );
    }
);