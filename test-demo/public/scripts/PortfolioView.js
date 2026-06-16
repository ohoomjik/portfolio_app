const portfoliosList = document.getElementById('portfoliosList');
const searchInput = document.getElementById('searchInput');
const searchBtn = document.getElementById('searchBtn');

async function loadPortfolios(search = '') {
    const response = await fetch(
        `/api/portfolios/search?search=${encodeURIComponent(search)}`
    );
    const portfolios = await response.json();
    renderPortfolios(portfolios);
}

function renderPortfolios(portfolios) {
    if (!portfolios.length) {
        portfoliosList.innerHTML = `<div class="empty">Портфолио не найдены</div>`;
        return;
    }

    portfoliosList.innerHTML = portfolios.map(portfolio => `
        <div class="portfolio-card">
            <h3>${portfolio.title ?? 'Без названия'}</h3>
            <div class="author">
                👤 ${portfolio.user?.name ?? 'Пользователь'}
            </div>
            <div class="description">
                ${portfolio.description ?? 'Нет описания'}
            </div>
            <div class="skills"> ${
                    portfolio.skills?.map(skill => `
                        <span class="skill-tag">
                            ${skill.name}
                        </span>
                    `).join('') || ''
                }
            </div>
            <button class="view-btn" onclick="location.href='/portfolio/${portfolio.id}'">Открыть портфолио</button>
            </div>
    `).join('');
}

searchBtn.addEventListener('click', () => {
    loadPortfolios(searchInput.value);
});
searchInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        loadPortfolios(searchInput.value);
    }
});
loadPortfolios();

const isAdmin = window.authUser && window.authUser.isAdmin;

function renderPortfolios(portfolios) {
    const container = document.getElementById('portfoliosList');

    if (!portfolios.length) {
        container.innerHTML = '<div class="empty">Портфолио не найдены</div>';
        return;
    }

    container.innerHTML = portfolios.map(p => {
        const skills = (p.skills || [])
            .map(s => `<span class="skill-tag">${s.name}</span>`)
            .join('');

        const adminBtn = isAdmin
            ? `<button class="view-btn" style="margin-top:0.5rem; background:#fef3c7; color:#92400e;"
                       onclick="location.href='/admin/portfolio/${p.id}/edit'">
                   ✏️ Редактировать (admin)
               </button>`
            : '';

        return `
            <div class="portfolio-card">
                <h3>${p.title || 'Без названия'}</h3>
                <div class="author">👤 ${p.user ? p.user.name : ''}</div>
                <p class="description">${p.description || ''}</p>
                <div class="skills">${skills}</div>
                <button class="view-btn" onclick="location.href='/portfolio/${p.id}'">
                    Просмотреть
                </button>
                ${adminBtn}
            </div>
        `;
    }).join('');
}

function search() {
    const query = document.getElementById('searchInput').value;
    fetch(`/api/portfolios/search?search=${encodeURIComponent(query)}`)
        .then(r => r.json())
        .then(renderPortfolios)
        .catch(() => {
            document.getElementById('portfoliosList').innerHTML =
                '<div class="empty">Ошибка загрузки</div>';
        });
}

document.getElementById('searchBtn').addEventListener('click', search);
document.getElementById('searchInput').addEventListener('keydown', e => {
    if (e.key === 'Enter') search();
});

search();
