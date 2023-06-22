<?php
 use App\Services\Page;
 use App\controllers\User;

 if ($_SESSION['user'] && $_SESSION['user']['group'] !== "2") {
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
    <h1 class="mt-4 mb-4">Admin Page</h1>

    <h2>Users</h2>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Avatar</th>
          <th scope="col">Fullname</th>
          <th scope="col">Email</th>
          <th scope="col">Username</th>
          <th scope="col">Admin</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $users = User::getAll();

          foreach ($users as $user) {
            ?>
              <tr class="user-card">
                <th scope="row"><?= $user['id'] ?></th>
                <td>
                  <div class="user-card__img">
                    <img src="<?= $user['avatar'] ?>" alt="avatar">
                  </div>
                </td>
                <td><?= $user['fullname'] ?></td>
                <td><?= $user['email'] ?></td>
                <td>@<?= $user['username'] ?></td>
                <td>
                  <?php
                    if ($user['group'] * 1 === 2) {
                      echo "Yes";
                    } else {
                      echo "No";
                    } 
                  ?>
                </td>
              </tr>
            <?php
          }
        ?>
      </tbody>
    </table>

  </div>
</main>
  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>