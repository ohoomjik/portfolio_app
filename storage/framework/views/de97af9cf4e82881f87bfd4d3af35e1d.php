<div class="main-container" style="margin-top: 0; padding-top: 0;">
<div class="portfolio-view" style="margin-top: 0;">
    <div class="portfolio-header" style="display:flex; justify-content:space-between; align-items:center;">
        <h2 style="margin:0;">👥 Управление пользователями</h2>
    </div>

    <div style="display:flex; gap:0.75rem; margin-bottom:1.25rem;">
        <input type="text" id="adminUserSearch"
               placeholder="Поиск по имени или email..."
               style="flex:1; padding:0.75rem 1rem; border:2px solid #e5e7eb; border-radius:0.75rem; font-size:0.9rem; font-family:inherit; transition: border-color 0.2s;"
               onfocus="this.style.borderColor='#667eea'" onblur="this.style.borderColor='#e5e7eb'">
        <button onclick="adminLoadUsers()"
                style="padding:0.75rem 1.5rem; background:linear-gradient(135deg,#667eea,#764ba2); color:white; border:none; border-radius:0.75rem; font-weight:600; cursor:pointer;">
            Найти
        </button>
    </div>

    <div id="adminUsersTable"></div>
</div>
</div>

<div id="adminEditModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:999; align-items:center; justify-content:center;">
    <div style="background:white; border-radius:1.5rem; padding:2rem; width:100%; max-width:440px; margin:1rem; box-shadow:0 25px 50px rgba(0,0,0,0.3);">
        <h3 style="margin-bottom:1.25rem; font-size:1.25rem; color:#1f2937;">✏️ Редактировать пользователя</h3>
        <input type="hidden" id="editUserId">
        <div style="margin-bottom:1rem;">
            <label style="display:block; margin-bottom:0.4rem; font-size:0.85rem; font-weight:600; color:#374151;">Имя</label>
            <input type="text" id="editUserName"
                   style="width:100%; padding:0.75rem; border:2px solid #e5e7eb; border-radius:0.75rem; font-size:1rem; font-family:inherit; box-sizing:border-box;"
                   onfocus="this.style.borderColor='#667eea'" onblur="this.style.borderColor='#e5e7eb'">
        </div>
        <div style="margin-bottom:1.25rem;">
            <label style="display:block; margin-bottom:0.4rem; font-size:0.85rem; font-weight:600; color:#374151;">Email</label>
            <input type="email" id="editUserEmail"
                   style="width:100%; padding:0.75rem; border:2px solid #e5e7eb; border-radius:0.75rem; font-size:1rem; font-family:inherit; box-sizing:border-box;"
                   onfocus="this.style.borderColor='#667eea'" onblur="this.style.borderColor='#e5e7eb'">
        </div>
        <div id="editUserError" style="display:none; background:#fee2e2; color:#dc2626; padding:0.6rem 0.75rem; border-radius:0.5rem; font-size:0.85rem; margin-bottom:1rem;"></div>
        <div style="display:flex; gap:0.75rem;">
            <button onclick="adminSaveUser()"
                    style="flex:1; padding:0.75rem; background:linear-gradient(135deg,#667eea,#764ba2); color:white; border:none; border-radius:0.75rem; font-weight:600; cursor:pointer;">
                Сохранить
            </button>
            <button onclick="document.getElementById('adminEditModal').style.display='none'"
                    style="flex:1; padding:0.75rem; background:#f3f4f6; color:#374151; border:none; border-radius:0.75rem; font-weight:600; cursor:pointer;">
                Отмена
            </button>
        </div>
    </div>
</div>

<script>
const ADMIN_CSRF    = '<?php echo e(csrf_token()); ?>';
const ADMIN_SELF_ID = <?php echo e(auth()->id()); ?>;

async function adminLoadUsers() {
    const search = document.getElementById('adminUserSearch').value;
    const table  = document.getElementById('adminUsersTable');
    table.innerHTML = '<p style="text-align:center;color:#6b7280;padding:1rem;">Загрузка...</p>';

    const res   = await fetch('/api/admin/users?search=' + encodeURIComponent(search));
    const users = await res.json();

    if (!users.length) {
        table.innerHTML = '<p style="text-align:center;color:#9ca3af;padding:1rem;">Пользователи не найдены</p>';
        return;
    }

    table.innerHTML = `
        <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; font-size:0.875rem;">
            <thead>
                <tr style="background:#f9fafb; border-bottom:2px solid #e5e7eb;">
                    <th style="padding:0.75rem 1rem; text-align:left; color:#6b7280; font-weight:600;">ID</th>
                    <th style="padding:0.75rem 1rem; text-align:left; color:#6b7280; font-weight:600;">Имя</th>
                    <th style="padding:0.75rem 1rem; text-align:left; color:#6b7280; font-weight:600;">Email</th>
                    <th style="padding:0.75rem 1rem; text-align:left; color:#6b7280; font-weight:600;">Роль</th>
                    <th style="padding:0.75rem 1rem; text-align:left; color:#6b7280; font-weight:600;">Действия</th>
                </tr>
            </thead>
            <tbody>
                ${users.map(u => `
                <tr style="border-bottom:1px solid #f3f4f6; transition:background 0.15s;"
                    onmouseover="this.style.background='#fafafa'" onmouseout="this.style.background=''">
                    <td style="padding:0.75rem 1rem; color:#9ca3af;">#${u.id}</td>
                    <td style="padding:0.75rem 1rem; font-weight:500; color:#1f2937;">${u.name}</td>
                    <td style="padding:0.75rem 1rem; color:#4b5563;">${u.email}</td>
                    <td style="padding:0.75rem 1rem;">
                        <span style="padding:0.2rem 0.6rem; border-radius:1rem; font-size:0.75rem; font-weight:600;
                            ${u.role === 'admin'
                                ? 'background:#ede9fe; color:#5b21b6;'
                                : 'background:#dcfce7; color:#166534;'}">
                            ${u.role === 'admin' ? '👑 admin' : '👤 user'}
                        </span>
                    </td>
                    <td style="padding:0.75rem 1rem;">
                        <div style="display:flex; gap:0.5rem;">
                            <button onclick="adminOpenEdit(${u.id}, '${u.name.replace(/'/g,"\\'")}', '${u.email}')"
                                    style="padding:0.35rem 0.75rem; background:#e0e7ff; color:#3730a3; border:none; border-radius:0.5rem; cursor:pointer; font-size:0.8rem; font-weight:500;">
                                ✏️
                            </button>
                            ${u.id !== ADMIN_SELF_ID ? `
                            <button onclick="adminDeleteUser(${u.id})"
                                    style="padding:0.35rem 0.75rem; background:#fee2e2; color:#dc2626; border:none; border-radius:0.5rem; cursor:pointer; font-size:0.8rem; font-weight:500;">
                                🗑️
                            </button>` : `
                            <span style="padding:0.35rem 0.75rem; color:#9ca3af; font-size:0.75rem;">это вы</span>`}
                        </div>
                    </td>
                </tr>`).join('')}
            </tbody>
        </table>
        </div>`;
}

function adminOpenEdit(id, name, email) {
    document.getElementById('editUserId').value    = id;
    document.getElementById('editUserName').value  = name;
    document.getElementById('editUserEmail').value = email;
    document.getElementById('editUserError').style.display = 'none';
    document.getElementById('adminEditModal').style.display = 'flex';
}

async function adminSaveUser() {
    const id    = document.getElementById('editUserId').value;
    const name  = document.getElementById('editUserName').value.trim();
    const email = document.getElementById('editUserEmail').value.trim();
    const errEl = document.getElementById('editUserError');
    errEl.style.display = 'none';

    const res  = await fetch(`/api/admin/users/${id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': ADMIN_CSRF },
        body: JSON.stringify({ name, email })
    });
    const data = await res.json();

    if (!res.ok) {
        const msg = data.errors
            ? Object.values(data.errors).flat().join(' ')
            : (data.error || 'Ошибка сохранения');
        errEl.textContent = msg;
        errEl.style.display = 'block';
        return;
    }

    document.getElementById('adminEditModal').style.display = 'none';
    adminLoadUsers();
}

async function adminDeleteUser(id) {
    if (!confirm('Удалить пользователя? Это действие необратимо.')) return;

    const res  = await fetch(`/api/admin/users/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': ADMIN_CSRF }
    });
    const data = await res.json();

    if (!res.ok) {
        alert(data.error || 'Ошибка удаления');
        return;
    }

    adminLoadUsers();
}

document.getElementById('adminUserSearch').addEventListener('keydown', e => {
    if (e.key === 'Enter') adminLoadUsers();
});

document.getElementById('adminEditModal').addEventListener('click', function (e) {
    if (e.target === this) this.style.display = 'none';
});

adminLoadUsers();
</script>
<?php /**PATH C:\xampp\htdocs\test-demo\resources\views/admin-users.blade.php ENDPATH**/ ?>