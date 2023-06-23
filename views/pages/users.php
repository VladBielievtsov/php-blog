<?php
 use App\Services\Page;
 use App\controllers\User;

 $searchRequest = $_GET['username'];

 $users = User::searchUser($searchRequest);

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
    <h1 class="mt-4">Search user</h1>
    <div class="search-users">

      <?php

        if (!empty($users)) {
          foreach ($users as $user) {
            ?> 
  
              <a href="user?id=<?= $user['id'] ?>" class="search-users__card">
                <div>
                  <img src="<?= $user['avatar'] ?>" alt="<?= $user['username'] ?>">
                </div>
                <div>
                  <h5>
                    <?= $user['fullname'] ?>
                  </h5>
                  <p>@<?= $user['username'] ?></p>
                </div>
              </a>
  
            <?php
          }
        } else {
          ?> <h4>User not found 😔</h4> <?php
        }

      ?>

    </div>
  </div>
</main>
  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>