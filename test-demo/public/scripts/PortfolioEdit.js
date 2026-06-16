document.addEventListener('DOMContentLoaded', () => {
    let projectIndex = document.querySelectorAll(
        'input[name^="projects["][name$="[title]"]'
    ).length;

    const addProjectBtn = document.getElementById('addProjectBtn');

    addProjectBtn?.addEventListener('click', () => {
        const wrapper = document.createElement('div');
        wrapper.className = 'input-group';

        wrapper.innerHTML = `
            <input name="projects[${projectIndex}][title]"
                   placeholder="Название проекта">
            <input name="projects[${projectIndex}][description]"
                   placeholder="Описание">
        `;

        addProjectBtn.before(wrapper);
        projectIndex++;
    });

    const addImageBtn = document.getElementById('addImageBtn');

    let imageInputs = document.getElementById('imageInputs');
    if (!imageInputs && addImageBtn) {
        imageInputs = document.createElement('div');
        imageInputs.id = 'imageInputs';
        addImageBtn.before(imageInputs);
    }

    let imagePreview = document.getElementById('imagePreview');
    if (!imagePreview && addImageBtn) {
        imagePreview = document.createElement('div');
        imagePreview.id = 'imagePreview';
        imagePreview.className = 'images-grid';
        addImageBtn.before(imagePreview);
    }

    function wireImageInput(input) {
        input.addEventListener('change', () => {
            const file = input.files && input.files[0];

            const previewBox = input.closest('.input-group')?.querySelector('.file-preview');
            if (!previewBox) return;

            previewBox.innerHTML = '';

            if (!file) return;
            if (!file.type.startsWith('image/')) {
                previewBox.innerHTML = '<p>Выберите изображение</p>';
                return;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                previewBox.innerHTML = `
                    <img src="${e.target.result}" alt="preview"
                         style="width: 100%; max-width: 280px; border-radius: 12px; display: block;">
                `;
            };
            reader.readAsDataURL(file);
        });
    }

    function createImageInput() {
        const wrapper = document.createElement('div');
        wrapper.className = 'input-group';
        wrapper.innerHTML = `
            <input type="file" name="images[]" accept="image/*">
            <div class="file-preview" style="margin-top: 10px;"></div>
        `;

        const input = wrapper.querySelector('input[type="file"]');
        wireImageInput(input);

        imageInputs.appendChild(wrapper);
    }

    const existingFileInputs = imageInputs
        ? imageInputs.querySelectorAll('input[type="file"][name="images[]"]')
        : [];

    if (existingFileInputs.length > 0) {
        existingFileInputs.forEach(wireImageInput);
    } else if (imageInputs) {
        createImageInput();
    }

    addImageBtn?.addEventListener('click', createImageInput);
});
document.querySelectorAll('.delete-image-btn').forEach(btn => {
    btn.addEventListener('click', async () => {
        const id = btn.dataset.id;
        if (!confirm('Удалить изображение?')) return;
        const response = await fetch(`/image/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        });
        if (response.ok) {
            btn.closest('.image-card').remove();
        }
    });
});
