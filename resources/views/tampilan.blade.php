@extends('layouts.navbartop')
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="css/tampilan.css">
  <script src="{{ asset('js/tampilan.js') }}" defer></script>
  <title>Simple Pict</title>
</head>

<body>

    <!-- Photos bar -->
    <div class = "results" >
        @if(isset($keyword) && $keyword)
            <p>Hasil pencarian untuk: <strong>{{ $keyword }}</strong></p>
        @endif
    </div>
    
    <div class="container photo-container page">
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
            <p>Tidak ada hasil yang ditemukan.</p>
        @endif
    </div>

    <script>
        // Fungsi untuk menampilkan preview gambar
        document.querySelectorAll('.box img').forEach(img => {
            img.addEventListener('click', function () {
                const title = encodeURIComponent(this.getAttribute('data-title'));
                const description = encodeURIComponent(this.getAttribute('data-description'));
                const idpost = encodeURIComponent(this.getAttribute('data-id'));
                const image = encodeURIComponent(this.getAttribute('src'));
                
                // window.location.href = `/preview?title=${title}&description=${description}&image=${image}`;
                window.location.href = `/preview?title=${title}&description=${description}&image=${image}&id_post=${idpost}`;
                
            });
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"></script>
</body>
</html>