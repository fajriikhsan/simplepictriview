document.getElementById('upload-button').addEventListener('click', function () {
    const form = document.getElementById('upload-form');
    const formData = new FormData(form);
    const uploadButton = this;

    // Disable button during upload to prevent multiple submissions
    uploadButton.disabled = true;
    uploadButton.innerHTML = '<i class="bx bx-loader bx-spin"></i> Uploading...';

    // Pastikan ada file yang dipilih
    const imageInput = document.getElementById('image');
    if (imageInput.files.length === 0) {
        alert('Silakan pilih gambar terlebih dahulu!');
        resetUploadButton();
        return;
    }

    // Kirim request dengan fetch API
    fetch('/upload', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Tampilkan pesan sukses
            alert(data.message);

            // Reset form
            resetForm();
        } else {
            alert(data.message || 'Gambar gagal diupload!');
        }
    })
    .catch(error => {
        console.error("Error uploading image:", error);
        alert('Terjadi kesalahan saat mengupload gambar.');
    })
    .finally(() => {
        // Re-enable button
        resetUploadButton();
    });

    function resetForm() {
        form.reset(); // Reset form fields
        
        const preview = document.getElementById('preview');
        preview.src = '';
        preview.style.display = 'none';
        
        document.querySelector('.image-area .icon').style.display = 'block';
        document.querySelector('.image-area h3').style.display = 'block';
    }

    function resetUploadButton() {
        uploadButton.disabled = false;
        uploadButton.innerHTML = '<i class="bx bx-send"></i> Submit';
    }
});