document.addEventListener('DOMContentLoaded', function() {
    const serviceSelect = document.getElementById('service');
    const plagaGroup = document.getElementById('plaga-group');
    const imageUpload = document.getElementById('image-upload');
    const imagePreview = document.getElementById('image-preview');
    const previewImage = document.getElementById('preview-image');

    // Mostrar/Ocultar campo de plaga
    serviceSelect.addEventListener('change', function() {
        if (this.value === 'plagas') {
            plagaGroup.style.display = 'block';
        } else {
            plagaGroup.style.display = 'none';
        }
    });

    // Vista previa de imagen
    imageUpload.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                imagePreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });
});