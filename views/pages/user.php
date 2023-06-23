<?php
 use App\Services\Page;
 use App\controllers\Post;
 use App\controllers\User;

 if (isset($_GET['id'])) {
  $userById = $_GET['id'];
 } else {
  \App\Services\Router::redirect('/');
}

  if ($_GET['id'] === $_SESSION['user']['id']) {
    \App\Services\Router::redirect('/profile');
  }

  $user = User::getById($_GET['id']);

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
  <div class="profile container">
    <div class="profile__img">
      <img 
        src="<?= $user['avatar'] ?>" 
        alt="<?= $user['fullname'] ?>"
        width="180"
      >
    </div>
    <h2><?= $user['fullname'] ?></h2>
    <p class="username">@<?= $user['username'] ?></p>
  </div>
  <div class="container">
    <div class="posts">
      <?php
        $posts = Post::getAll($user['id']);

        if (!empty($posts)) {
          foreach ($posts as $post) {
            ?>
              <a href="/post?id=<?= $post['id'] ?>" class="card">
                <img src="<?= $post['image'] ?>" class="card-img-top" alt="<?= $post['title'] ?>">
                <div class="card-body">
                  <div class="d-flex gap-2 justify-content-between">
                    <span><?= $post['date'] ?></span>
                  </div>
                  <h5 class="card-title"><?= $post['title'] ?></h5>
                </div>
              </a>
            <?php
          }
        } else {
          ?> <h4>There are no posts 😔</h4> <?php
        }
        
      ?>
      </div>
  </div>
</main>
  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="/assets/js/main.js"></script>
</body>
</html>