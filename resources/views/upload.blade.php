@extends('layouts.navbartop')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Page</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/upload.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
   <form id="upload-form" enctype="multipart/form-data" method="POST" action="{{ route('upload.store') }}">
       @csrf
       <div class="container">
           <div class="upload-section">
               <div class="image-area">
                   <i class='bx bx-image icon'></i>
                   <h3>Upload Image</h3>
                   <!-- Gambar pratinjau -->
                   <img src="" alt="Preview" id="preview" style="display: none;">
               </div>
               
               <!-- Input file untuk memilih gambar -->
               <input type="file" id="image" name="image" accept="image/*" style="display: none;" onchange="previewImage()">
               
               <button type="button" class="select-image" onclick="document.getElementById('image').click()">
                   <i class='bx bx-upload'></i> Pilih Gambar
               </button>
           </div>
           <div class="input-section">
               <label for="judul_post">Judul</label>
               <input type="text" id="judul_post" name="judul_post" placeholder="Masukkan Judul">
               
               <label for="desk_post">Deskripsi</label>
               <textarea id="desk_post" name="desk_post" placeholder="Masukkan Deskripsi"></textarea>
               
               <button id="upload-button" type="button" class="submit-btn">
                   <i class='bx bx-send'></i> Submit
               </button>
           </div>
       </div>
   </form>

   <script src="{{ asset('js/upload.js') }}"></script>
   <script>
      function previewImage() {
          const fileInput = document.getElementById('image');
          const preview = document.getElementById('preview');
          
          if (fileInput.files && fileInput.files[0]) {
              const reader = new FileReader();
              
              reader.onload = function (e) {
                  preview.src = e.target.result;
                  preview.style.display = 'block';
                  document.querySelector('.image-area .icon').style.display = 'none';
                  document.querySelector('.image-area h3').style.display = 'none';
              };
              
              reader.readAsDataURL(fileInput.files[0]);
          }
      }

      // Optional: Reset preview if no file selected
      document.getElementById('image').addEventListener('change', function() {
          if (this.files.length === 0) {
              document.getElementById('preview').style.display = 'none';
              document.querySelector('.image-area .icon').style.display = 'block';
              document.querySelector('.image-area h3').style.display = 'block';
          }
      });
   </script>
</body>
</html>