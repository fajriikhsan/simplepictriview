@extends('layouts.navbartop')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/profile.css">
    <title>Profile</title>
</head>
<body>
    <div class="container">
        <!-- Gambar Profil -->
        <div class="upload-section">
            <form id="profileUpdateForm" action="{{ route('profile.updatePhoto') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="image-area">
                    <i class='bx bx-image icon' id="uploadIcon"></i>
                    <img src="{{ Auth::user()->profile_photo ? asset('storage/profile_photos/' . Auth::user()->profile_photo) : asset('profile.jpg') }}" 
                        alt="Profile Picture" 
                        class="profile-img" 
                        id="profileImg">
                    <input type="file" name="profile_photo" id="profileInput" accept="image/*" style="display: none;">
                </div>
            </form>
        </div>

        <div class="username">
            @if(Auth::check())
                {{ Auth::user()->username }}
            @else
                Guest
            @endif
        </div>

        <div class="button-group">
            <button class="select-image" id="postsBtn" onclick="showPosts()">Postingan</button>
            <button class="select-image" id="savedBtn" onclick="showSaved()">Tersimpan</button>
        </div>

        <!-- Bagian Postingan Saya -->
        <div id="posts" class="content-section">
            <h2>Postingan Saya</h2>
            <div class="photo-container">
                @if(isset($uploads) && $uploads->count() > 0)
                    @foreach($uploads as $upload)
                        <div class="box">
                            <img src="{{ asset('storage/' . $upload->file_post) }}" 
                                alt="{{ $upload->judul_post }}" 
                                data-title="{{ $upload->judul_post }}" 
                                data-description="{{ $upload->desk_post }}" 
                                data-id="{{ $upload->id_post }}">
                        </div>
                    @endforeach
                @else
                    <p>Belum ada postingan.</p>
                @endif
            </div>
        </div>

        <!-- Bagian Foto Tersimpan -->
        <div id="saved" class="content-section" style="display: none;">
            <h2>Postingan Tersimpan</h2>
                <div class="photo-container">
                    @if(isset($savedPosts) && $savedPosts->count() > 0)
                        @foreach($savedPosts as $savedPost)
                            <div class="box">
                                <img src="{{ asset('storage/' . $savedPost->upload?->file_post) }}" 
                                    alt="{{ $savedPost->upload?->judul_post }}" 
                                    data-title="{{ $savedPost->upload?->judul_post }}" 
                                    data-description="{{ $savedPost->upload?->desk_post }}"
                                    data-id="{{ $savedPost->upload?->id_post }}">
                            </div>
                        @endforeach
                    @else
                        <p>Belum ada postingan yang tersimpan.</p>
                    @endif
                </div>
        </div>
    </div>

    <script>
        // Fungsi untuk mengunggah foto profil
        const uploadIcon = document.getElementById('uploadIcon');
        const profileInput = document.getElementById('profileInput');
        const profileImg = document.getElementById('profileImg');
        const profileUpdateForm = document.getElementById('profileUpdateForm');
        
        uploadIcon.addEventListener('click', () => {
            profileInput.click();
        });

        profileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) 
            {
                const reader = new FileReader();
                reader.onload = (e) => {
                    profileImg.src = e.target.result;
                    profileImg.style.display = 'block';
                    uploadIcon.style.display = 'none';
                    
        
                };
                reader.readAsDataURL(file);
                
                // Submit form ketika file dipilih
                profileUpdateForm.submit();
                
            }
            
        });
        uploadIcon.classList.add('hidden'); // Menyembunyikan icon

        // Fungsi untuk menampilkan bagian Postingan
        function showPosts() {
            document.getElementById('posts').style.display = 'block';
            document.getElementById('saved').style.display = 'none';
            document.getElementById('postsBtn').classList.add('active');
            document.getElementById('savedBtn').classList.remove('active');
        }

        // Fungsi untuk menampilkan bagian Tersimpan
        function showSaved() {
            document.getElementById('posts').style.display = 'none';
            document.getElementById('saved').style.display = 'block';
            document.getElementById('savedBtn').classList.add('active');
            document.getElementById('postsBtn').classList.remove('active');
        }

        // Fungsi untuk menampilkan preview gambar
        document.querySelectorAll('.box img').forEach(img => {
            img.addEventListener('click', function () {
                const title = encodeURIComponent(this.getAttribute('data-title'));
                const description = encodeURIComponent(this.getAttribute('data-description'));
                const image = encodeURIComponent(this.getAttribute('src'));
                const id_post = this.getAttribute('data-id'); // Ambil id_post
                
                // Pastikan id_post ada sebelum redirect
                if (id_post) {
                    window.location.href = `/preview?title=${title}&description=${description}&image=${image}&id_post=${id_post}`;
                } else {
                    console.error('ID post tidak ditemukan');
                }
            });
        });
    </script>
</body>
</html>