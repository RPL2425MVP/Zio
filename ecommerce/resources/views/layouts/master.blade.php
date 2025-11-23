<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://cdn.boxicons.com/3.0.3/fonts/basic/boxicons.min.css' rel='stylesheet'>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Hello, world!</title>
    <style>
      body{
        font-family: "Gill Sans", sans-serif;
        text-decoration: none;
      }
      body a{
        text-decoration: none;
      }
        .body{
            position: relative;
        }
            .navbar {
        height: 75px;
        font-size: 18px;
    }
    /* Logo di tengah */
    .navbar-brand {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        font-size: 24px;
        font-weight: bold;
        z-index: 10;
    }
    .bx {
        font-weight: bold;
        font-size: 20px;
    }
    /* Search bar dengan ikon di dalam */
    .search-wrapper {
        position: relative;
        display: inline-block;
    }
    .search-wrapper input {
        padding-right: 36px; 
        height: 38px;
        width: 160px;
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        font-size: 14px;
    }
    .search-wrapper i {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        color: #6c757d;
    }
    /* Efek scroll */
    #mainNavbar.navbar-hidden {
        transform: translateY(-100%);
        transition: transform 0.3s ease;
    }

    /* Mobile */
    @media (max-width: 991.98px) {
        .navbar-brand {
            position: static;
            transform: none;
            text-align: center;
            margin: 0.5rem 0;
            order: 1;
        }
        .navbar-nav,
        .navbar-icons {
            justify-content: center;
            padding-left: 0;
            order: 2;
        }
        .search-wrapper {
            display: none;
        }
        .navbar-toggler {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            z-index: 11;
        }
    }
    </style>
  </head>
  <body>
    <div class="header">
    @include('layouts.navbar')
    </div>

    {{-- isi konten --}}
    @yield('konten')


<div class="footer">
    @include('layouts.footer')
</div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <script>
      document.addEventListener('DOMContentLoaded', function () {
          const navbar = document.getElementById('mainNavbar');
          let lastScrollTop = 0;

          window.addEventListener('scroll', function() {
              const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

              if (scrollTop > lastScrollTop) {
                  // Scroll ke bawah → sembunyikan
                  navbar.classList.add('navbar-hidden');
              } else {
                  // Scroll ke atas → tampilkan
                  navbar.classList.remove('navbar-hidden');
              }

              // Cegah nilai negatif
              lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
          });
      });
    </script>
  </body>
</html>