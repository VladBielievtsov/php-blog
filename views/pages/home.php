<?php
 use App\Services\Page;
 use App\controllers\Post;

 if (isset($_GET['delete'])) {
  $removeById = $_GET['delete'];
  Post::remove($removeById);
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
    <h1 class="mt-4">Posts</h1>
    <div class="posts">
    <?php
      $posts = Post::getAll();

      if (!empty($posts)) {
        foreach ($posts as $post) {
          ?>
            <a href="/post?id=<?= $post['id'] ?>" class="card">
              <img src="<?= $post['image'] ?>" class="card-img-top" alt="<?= $post['title'] ?>">
              <div class="card-body">
                <div class="d-flex gap-2 justify-content-between">
                  <span><?= $post['date'] ?></span>
                  <?php
                    if ($post['author'] == $_SESSION['user']['id']) {
                      ?>
                      <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><circle cx="256" cy="256" r="32" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/><circle cx="416" cy="256" r="32" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/><circle cx="96" cy="256" r="32" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/></svg>
                        </button>
                        <ul class="dropdown-menu">
                          <object>
                            <li><a class="dropdown-item confirmation" href="?delete=<?= $post['id'] ?>">Remove</a></li>
                          </object>
                        </ul>
                      </div>
                      <?php
                    }
                  ?>
                </div>
                <h5 class="card-title"><?= $post['title'] ?></h5>
              </div>
            </a>
          <?php
        }
      } else {
        ?> <h4>There are no posts</h4> <?php
      }

    ?>
    </div>
  </div>
</main>
  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>