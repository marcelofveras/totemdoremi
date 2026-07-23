const monthSelect = document.getElementById('monthSelect');
const monthTitle = document.getElementById('monthTitle');
const studentsContainer = document.getElementById('studentsContainer');

async function loadBirthdays(month) {
  monthTitle.textContent = `Aniversariantes - ${getMonthName(month)}`;
  studentsContainer.innerHTML = '<div class="col-12"><div class="text-center p-5"><div class="spinner-border"></div></div></div>';

  try {
    const response = await fetch(`api/aniversariantes.php?mes=${encodeURIComponent(month)}`);
    const students = await response.json();

    if (!students.length) {
      studentsContainer.innerHTML = '<div class="col-12"><div class="alert alert-secondary">Nenhum aniversariante encontrado para este mês.</div></div>';
      return;
    }

    studentsContainer.innerHTML = '';
    students.forEach(student => {
      const dataFormatada = formatBirthday(student.data_nascimento);
      studentsContainer.innerHTML += `
        <div class="col-md-4 col-lg-3">
          <div class="card h-100">
            <img src="https://vpn.doremieducacao.com.br/familiadoremi/img/fotos/${student.cpf}.bmp" class="card-img-top student-photo" onerror="this.src='img/user.png'">
            <div class="card-body text-center">
              <h5 class="card-title mb-2">${student.nome}</h5>
              <div class="text-muted small">${student.turma || ''}</div>
              <div class="mt-3">
                <span class="badge-pill bg-primary-subtle text-primary">${dataFormatada}</span>
              </div>
            </div>
          </div>
        </div>
      `;
    });
  } catch (error) {
    console.error(error);
    studentsContainer.innerHTML = '<div class="col-12"><div class="alert alert-danger">Erro ao carregar aniversariantes.</div></div>';
  }
}

function getMonthName(month) {
  const months = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
  return months[Number(month) - 1] || '';
}

function formatBirthday(value) {
  if (!value) {
    return '';
  }

  const date = new Date(value);
  if (Number.isNaN(date.getTime())) {
    return value;
  }

  const day = String(date.getDate()).padStart(2, '0');
  const month = String(date.getMonth() + 1).padStart(2, '0');
  return `${day}/${month}`;
}

monthSelect.addEventListener('change', (event) => {
  loadBirthdays(event.target.value);
});

window.addEventListener('DOMContentLoaded', () => {
  const currentMonth = new Date().getMonth() + 1;
  monthSelect.value = currentMonth;
  loadBirthdays(currentMonth);
});
