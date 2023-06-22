<?php
 use App\Services\Page;

 if ($_SESSION["user"]) {
  \App\Services\Router::redirect('/profile');
 }
 
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
  <?php
    Page::part('Head');
    ?>
</head>
<body>
  
<?php
  Page::part('Nav');
?>

<main>
  <div class="container">
    <h1 class="mt-4">Sign up</h1>
    <form class="mt-4" action="/auth/register" method="post" enctype="multipart/form-data">

      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="email">
      </div>
      <div class="mb-3">
        <label for="username" class="form-label">User name</label>
        <input type="text" name="username" class="form-control" id="username">
      </div>
      <div class="mb-3">
        <label for="fullname" class="form-label">Full name</label>
        <input type="text" name="fullname" class="form-control" id="fullname">
      </div>
      <div class="mb-3">
        <label for="avatar" class="form-label">User avatar</label>
        <input type="file" name="avatar" class="form-control" id="avatar">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password">
      </div>
      <div class="mb-3">
        <label for="password_confirm" class="form-label">Password Confirmation</label>
        <input type="password" name="password_confirm" class="form-control" id="password_confirm">
      </div>
      
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</main>
  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>