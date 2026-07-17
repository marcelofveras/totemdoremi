const modal = new bootstrap.Modal(
	document.getElementById('studentModal')
);

async function loadClass(className, element) {

	document.getElementById('classTitle').innerText = className;

	document.querySelectorAll('.nav-link').forEach(btn => {
		btn.classList.remove('active');
	});

	element.classList.add('active');

	const container = document.getElementById('studentsContainer');

	container.innerHTML = `
        <div class="text-center p-5">
            <div class="spinner-border"></div>
        </div>
    `;

	try {

		const response = await fetch(
			'fichas/api/ficha.php?turma=' + encodeURIComponent(className)
		);

		const students = await response.json();

		container.innerHTML = '';

		if (students.length === 0) {

			container.innerHTML = `
                <div class="col-12">
                    <div class="alert alert-secondary">
                        Nenhum aluno cadastrado nesta turma.
                    </div>
                </div>
            `;

			return;
		}

		students.forEach(student => {

			container.innerHTML += `
                <div class="col-md-4 col-lg-3">
                    <div class="card student-card h-100"
                         onclick='openStudentModal(${JSON.stringify(student).replace(/'/g, "&apos;")})'>

                        <img src="https://vpn.doremieducacao.com.br/familiadoremi/img/fotos/${student.cpf}.bmp"
                             class="card-img-top student-photo"
                             onerror="this.src='img/user.png'">

                        <div class="card-body text-center">
                            <h5 class="card-title mb-0">
                                ${student.firstName} ${student.lastName}
                            </h5>
                        </div>
                    </div>
                </div>
            `;
		});

	} catch (error) {

		container.innerHTML = `
            <div class="alert alert-danger">
                Erro ao carregar alunos.
            </div>
        `;

		console.error(error);
	}
}

function openStudentModal(student) {

	document.getElementById('modalStudentPhoto').src =
		`https://vpn.doremieducacao.com.br/familiadoremi/img/fotos/${student.cpf}.bmp`;

	document.getElementById('modalStudentPhoto').onerror = function() {
		this.src = 'img/user.png';
	};

	document.getElementById('modalStudentName').innerText =
		student.fullName;

	// =========================
	// PAIS
	// =========================

	const parentsContainer =
		document.getElementById('parentsContainer');

	parentsContainer.innerHTML = '';

	const pais = [
		{
			tipo: 'Pai',
			dados: student.parents.pai
		},
		{
			tipo: 'Mãe',
			dados: student.parents.mae
		}
	];

	pais.forEach(parent => {

		if (!parent.dados.nome) {
			return;
		}

		parentsContainer.innerHTML += `
            <div class="col-md-6">

                <div class="card h-100 shadow-sm">

                    <div class="card-body d-flex align-items-center gap-3">

                        <img
                            src="https://vpn.doremieducacao.com.br/familiadoremi/img/fotos/${parent.dados.cpf}.bmp"
                            class="rounded-circle"
                            width="90"
                            height="90"
                            style="object-fit:cover;object-position:center 15%;" 
                            onerror="this.src='img/user.png'"
                        >

                        <div>

                            <div class="text-muted small mb-1">
                                ${parent.tipo}
                            </div>

                            <h5 class="mb-2">
                                ${parent.dados.nome}
                            </h5>

                            <div>
                                📞 ${parent.dados.telefone || 'Não informado'}
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        `;
	});

	// =========================
	// AUTORIZADOS
	// =========================

	const authorizedContainer =
		document.getElementById('authorizedContainer');

	authorizedContainer.innerHTML = '';

	let autorizados = [];

	try {

		autorizados = JSON.parse(student.authorized);

	} catch (e) {

		console.error('Erro ao converter autorizados', e);
	}

	if (!autorizados || autorizados.length === 0) {

		authorizedContainer.innerHTML = `
            <div class="col-12">
                <div class="alert alert-secondary mb-0">
                    Nenhuma pessoa autorizada cadastrada.
                </div>
            </div>
        `;

	} else {

		autorizados.forEach(person => {

			authorizedContainer.innerHTML += `
                <div class="col-md-6 col-lg-4">

                    <div class="card h-100 shadow-sm">

                        <div class="card-body d-flex align-items-center gap-3">

                            <img
                                src="https://vpn.doremieducacao.com.br/familiadoremi/img/fotos/${person.cpf}.bmp"
                                class="rounded-circle"
                                width="90"
                                height="90"
								style="object-fit:cover;object-position:center 15%;" 
                                onerror="this.src='img/user.png'"
                            >

<div>

    <h5 class="mb-1">
        ${person.nome}
    </h5>

    <div class="text-muted small mb-1">
        ${person.parentesco || ''}
    </div>

    <div class="small">
        CPF: ${formatCPF(person.cpf)}
    </div>

</div>

                        </div>

                    </div>

                </div>
            `;
		});
	}

	modal.show();
}

// Carregamento inicial

window.addEventListener('DOMContentLoaded', () => {

	const firstButton = document.querySelector('.nav-link.active');

	if (firstButton) {

		loadClass(
			firstButton.innerText,
			firstButton
		);
	}
});

function formatCPF(cpf) {

    if (!cpf) {
        return '';
    }

    cpf = cpf.replace(/\D/g, '');

    return cpf.replace(
        /(\d{3})(\d{3})(\d{3})(\d{2})/,
        '$1.$2.$3-$4'
    );
}