<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <base href="/" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Blog Homepage</title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <!-- Bootstrap icons-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
      <a class="navbar-brand" href="">Blogging</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
          <li class="nav-item"><a class="nav-link active" aria-current="page" href="">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="about">About</a></li>
        </ul>
        <form class="d-flex">
          <?php
            if ($this->get('auth')) {
              echo '<button class="btn btn-success" onclick="location.href=\'post/new\'" type="button"><i class="bi-plus-square me-1"></i> New</button>&nbsp;';
              echo '<button class="btn btn-warning" onclick="location.href=\'logout\'" type="button"><i class="bi-door-closed me-1"></i> Logout</button>';
            } else {
              echo '<button class="btn btn-outline-dark" onclick="location.href=\'admin\'" type="button"><i class="bi-pencil-square me-1"></i> Admin</button>';
            }
          ?>  
        </form>
      </div>
    </div>
  </nav>
  <?= $content ?>
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
    </div>
  </footer>
  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  <script src="js/scripts.js"></script>
</body>

</html>