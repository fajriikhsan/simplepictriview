<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="css/navbar.css">
  <script src="{{ asset('js/tampilan.js') }}" defer></script>
    <title>@yield('navbar')</title>
</head>
<body>
     <!-- navbar atas -->
  <nav class="navbar-top">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-lg">
        <nav class="navbar navbar-light bg-light">
          <a class="navbar-brand" href="#">
            <img src="/image/logo.png" width="120" height="100" alt="Logo">
          </a>
        </nav>
        <div class="collapse navbar-collapse" id="navbar">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link {{ Request::is('beranda') ? 'active' : '' }}" aria-current="page" href="/beranda">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Request::is('upload') ? 'active' : '' }}" href="/upload">Upload</a>
            </li>
          </ul>
        </div>
        <!-- <div class="logout-container">
            <form action="{{ route('logout') }}" method="POST" id="logout-form">
            @csrf
                <button type="submit" class="logout-button">
                    <i class='bx bx-log-out'></i>
                        <span>Logout</span>
                </button>
            </form>
        </div> -->
        <div class="navbar-container" style="width : 100%">
          <form class="d-flex ms-auto align-items-center" role="search">
            <input class="form-control me-2 searching" type="search" placeholder="Search" aria-label="Search"
              onblur="resetSearchBox()" onkeypress="handleKeyPress(event)"></input>
            <!-- icon search -->
            <button class="btn btn-icon search-icon ms-2" type="button" aria-label="Search" onclick="toggleSearchBox()">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search"
                viewBox="0 0 16 16">
                <path
                  d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
              </svg>
            </button>
          </form>
          <!--logo icon -->
          <a href="/profile" class="ms-3 profile-icon {{ Request::is('profile') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
              class="bi bi-person-circle" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
              <path fill-rule="evenodd"
                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
            </svg>
          </a>
          <form action="{{ route('logout') }}" method="POST" id="logout-form">
          @csrf
              <button type="submit" class="logout-button ms-3">
                  <i class='bx bx-log-out'></i>
                      <span>Logout</span>
              </button>
          </form>
          <button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
            aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

        </div>
      </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"></script>
</body>
</html>