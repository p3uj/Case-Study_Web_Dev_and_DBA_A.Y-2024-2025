document.getElementById('image').addEventListener('change', function (event) {
    const file = event.target.files[0];
    const preview = document.getElementById('profilePreview');

    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
        };

        reader.readAsDataURL(file);
    }
});

