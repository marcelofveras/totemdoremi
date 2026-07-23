let courses = [];

async function loadCourses() {
  const menu = document.getElementById('courseMenu');
  const container = document.getElementById('studentsContainer');
  const title = document.getElementById('courseTitle');

  menu.innerHTML = '<div class="text-center small opacity-75">Carregando...</div>';
  container.innerHTML = '<div class="col-12"><div class="text-center p-5"><div class="spinner-border"></div></div></div>';

  try {
    const response = await fetch('api/cursosextra.php');
    courses = await response.json();

    if (!courses.length) {
      menu.innerHTML = '<div class="text-muted">Nenhum curso encontrado.</div>';
      container.innerHTML = '<div class="col-12"><div class="alert alert-secondary">Nenhum curso cadastrado.</div></div>';
      title.textContent = 'Cursos Extras';
      return;
    }

    menu.innerHTML = '';
    courses.forEach((course, index) => {
      const button = document.createElement('button');
      button.className = `btn btn-light text-start ${index === 0 ? 'active' : ''}`;
      button.textContent = course.descricao;
      button.onclick = () => loadCourseStudents(course, button);
      menu.appendChild(button);
    });

    loadCourseStudents(courses[0], menu.firstElementChild);
  } catch (error) {
    console.error(error);
    container.innerHTML = '<div class="col-12"><div class="alert alert-danger">Erro ao carregar cursos.</div></div>';
  }
}

async function loadCourseStudents(course, element) {
  const title = document.getElementById('courseTitle');
  const container = document.getElementById('studentsContainer');

  title.textContent = course.descricao;

  document.querySelectorAll('#courseMenu .btn').forEach(btn => btn.classList.remove('active'));
  element.classList.add('active');

  container.innerHTML = '<div class="col-12"><div class="text-center p-5"><div class="spinner-border"></div></div></div>';

  try {
    const response = await fetch(`api/cursosextra.php?codigo=${encodeURIComponent(course.codigo_curso)}`);
    const students = await response.json();

    const professorName = course.professor_nome || 'Professor não informado';
    const professorCpf = course.cpf_professor || '';
    const professorPhoto = professorCpf
      ? `https://vpn.doremieducacao.com.br/familiadoremi/img/fotos/${professorCpf}.bmp`
      : 'img/user.png';

    let html = `
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-body d-flex align-items-center gap-3">
            <img src="${professorPhoto}" class="rounded-circle" width="100" height="100" style="object-fit:cover; object-position:center;" onerror="this.src='img/user.png'">
            <div>
              <div class="text-muted small mb-1">Professor(a)</div>
              <h4 class="mb-0">${professorName}</h4>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 mt-3">
        <h4 class="mb-3">Alunos matriculados</h4>
      </div>
    `;

    if (!students.length) {
      html += '<div class="col-12"><div class="alert alert-secondary mb-0">Nenhum aluno matriculado neste curso.</div></div>';
      container.innerHTML = html;
      return;
    }

    students.forEach(student => {
      html += `
        <div class="col-md-4 col-lg-3">
          <div class="card course-card h-100">
            <img src="https://vpn.doremieducacao.com.br/familiadoremi/img/fotos/${student.cpf}.bmp" class="card-img-top student-photo" onerror="this.src='img/user.png'">
            <div class="card-body text-center">
              <h5 class="card-title mb-2">${student.nome}</h5>
              <div class="text-muted small">${student.turma || ''}</div>
              <div class="mt-3">
                <span class="badge-pill bg-primary-subtle text-primary">${student.situacao || 'Ativo'}</span>
              </div>
            </div>
          </div>
        </div>
      `;
    });

    container.innerHTML = html;
  } catch (error) {
    console.error(error);
    container.innerHTML = '<div class="col-12"><div class="alert alert-danger">Erro ao carregar alunos do curso.</div></div>';
  }
}

window.addEventListener('DOMContentLoaded', loadCourses);
