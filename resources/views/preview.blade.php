@extends('layouts.navbartop')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/preview.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <title>"Preview"</title>
</head>
<body>
    <div class="container">
        <!-- Left Section -->
        <div class="left-section">
            <div id="preview">
                <img src="" alt="Selected Image" id="previewImage">
            </div>
        </div>

        <!-- Right Section -->
        <div class="right-section">
            <div class="card">
                <div class="card-header">
                    <div class="user-info">
                        <img src="" alt="Profile Picture" class="profile-img" id="ownerProfileImg">
                        <div class="username" id="ownerUsername"></div>
                    </div>
                </div>

                <div class="card-body">
                    <h2 class="card-title" id="cardTitle"></h2>
                    <p class="card-description" id="cardDescription"></p>
                </div>

                <div class="card-footer">
                    <!-- Bookmark Icon -->
                    @csrf
                    <input type="hidden" name="id_post" id="id_post" value="">
                    <i class='bx bx-bookmark'></i>
                    
                    <!-- Tombol Delete (Trash Icon) - Hidden by default -->
                    <input type="hidden" name="post_user_id" id="post_user_id" value="{{ $post_user_id ?? '' }}">
                    <input type="hidden" name="current_user_id" id="current_user_id" value="{{ Auth::id() }}">
                    @if(Auth::check() && isset($post_user_id) && Auth::id() == $post_user_id)
                        <i class='bx bx-trash' id="deletePost"></i>
                    @endif
                    
                    <input type="hidden" name="id_user" id="id_user" value="">
                    <div class="footer-item"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Ambil parameter dari URL
        const params = new URLSearchParams(window.location.search);
        const title = params.get('title');
        const description = params.get('description');
        const image = params.get('image');
        const uploadId = params.get('id_post');
        const userId = params.get('id_user');
        
        // Masukkan data ke halaman
        document.getElementById('cardTitle').textContent = title;
        document.getElementById('cardDescription').textContent = description;
        document.getElementById('previewImage').src = image;
        document.getElementById('id_post').value = uploadId;
        document.getElementById('id_user').value = userId;

        // Bookmark functionality
        const bookmarkIcon = document.querySelector('.bx-bookmark');
        const deleteIcon = document.getElementById('deletePost');
        const previewImage = document.getElementById('previewImage');

        function fetchPostOwnerDetails() {
            if (uploadId) {
                fetch(`/get-post-owner/${uploadId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('ownerUsername').textContent = data.username;
                        document.getElementById('ownerProfileImg').src = data.profile_photo 
                            ? `/storage/profile_photos/${data.profile_photo}`
                            : '/profile.jpg';
                    })
                    .catch(error => {
                        console.error('Error fetching post owner details:', error);
                        // Set default values if error
                        document.getElementById('ownerUsername').textContent = 'Unknown User';
                        document.getElementById('ownerProfileImg').src = '/profile.jpg';
                    });
            }
        }
        // Panggil fungsi saat halaman dimuat
        fetchPostOwnerDetails();

        // Existing code to check saved status
        if (uploadId) {
            fetch(`/check-saved/${uploadId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.is_saved) {
                        bookmarkIcon.classList.add('active');
                    }
                })
                .catch(error => {
                    console.error('Error checking saved status:', error);
                });
        }

        bookmarkIcon.addEventListener('click', () => {
            if (!uploadId) {
                alert('ID post tidak ditemukan');
                return;
            }

            fetch('/toggle-save', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    id_post: uploadId
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    bookmarkIcon.classList.toggle('active');
                    alert(data.message);
                } else {
                    alert(data.message || 'Gagal menyimpan postingan');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan postingan');
            });
        });

        // Add delete functionality
        if (deleteIcon) {
            deleteIcon.addEventListener('click', function() {
                if (!uploadId) {
                    alert('ID post tidak ditemukan');
                    return;
                }

                if (confirm('Apakah Anda yakin ingin menghapus postingan ini?')) {
                    fetch(`/delete-post/${uploadId}`, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            alert('Postingan berhasil dihapus!');
                            window.location.href = '/profile';
                        } else {
                            alert(data.message || 'Gagal menghapus postingan');
                        }
                    })
                    .catch(error => {
                        console.error('Full error:', error);
                        alert('Terjadi kesalahan saat menghapus postingan');
                    });
                }
            });
        }
    </script>
</body>
</html>