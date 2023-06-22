<?php
  use App\Services\Page;
  use App\controllers\Post;

 
  if (!isset($_GET['id']) || empty($_GET['id'])) {
    \App\Services\Router::redirect('/');
  }
  
  $post = Post::getById($_GET['id']);
  $post = $post[0];

  $id = $_GET['id'];

  if (empty($post)) {
    \App\Services\Router::redirect('/');
  }
  
  $author = Post::getAuthor($post['author']);
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
    <div class="post-head">
      <?php
        $likes = $post['likes'];
        $likes = explode(' ', $likes);
        if (!in_array($_SESSION['user']['username'], $likes)) {
          if (isset($_POST['like'])) {
            $likes[] = $_SESSION['user']['username'];
            $likes = implode(' ', $likes);
            \R::exec("UPDATE posts SET likes = '$likes' WHERE id = $id");
            $liked = true;
          }
        } else {
          $liked = true;
          if (isset($_POST['like'])) {
            if (($key = array_search($_SESSION['user']['username'], $likes)) !== false) {
              unset($likes[$key]);
              $likes = implode(' ', $likes);
              \R::exec("UPDATE posts SET likes = '$likes' WHERE id = $id");
              $liked = false;
            }
          }
        }
      ?>
      <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4"><?= $post['title']; ?></h1>
        <div>
          <?php if (!$liked) { ?>
              <form method="post">
                <input type="submit" class="btn btn-danger" name="like" value="Like">
              </form>
            <?php } else { ?>
              <form method="post">
                <input type="submit" class="btn btn-danger" name="like" value="Liked">
              </form>
            <?php }
          ?>
        </div>
      </div>
      <div class="d-flex justify-content-between align-items-center">
        <a href="user?id=<?= $post['author'] ?>" class="post-head__author">
          <img 
            src="<?= $author['avatar'] ?>" 
            alt="<?= $author['fullname'] ?>"
          >
          <div class="d-flex gap-2">
            <p><strong><?= $author['fullname'] ?></strong></p> •
            <p><?= $post['date']; ?></p>
          </div>
        </a>
        <div>
          <span>Views: <?= $post['views']; ?></span>
        </div>
      </div>
      <img class="post-head__img" src="<?= $post['image']; ?>" alt="">
    </div>
    <div class="post-head__body">
      <?= $post['content']; ?>
    </div>
  </div>
</main>
  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>