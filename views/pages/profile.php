<?php
 use App\Services\Page;
 use App\controllers\Post;

 if (!$_SESSION["user"]) {
  \App\Services\Router::redirect('/login');
 }

 if (isset($_GET['delete'])) {
   $removeById = $_GET['delete'];
   Post::remove($removeById);
 }

 $posts = Post::getAll($_SESSION["user"]['id']);
 $likedPosts = Post::getLikedPosts($_SESSION["user"]['username'])
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
        src="<?= $_SESSION["user"]['avatar'] ?>" 
        alt="<?= $_SESSION["user"]['fullname'] ?>"
        width="180"
      >
    </div>
    <h2><?= $_SESSION["user"]['fullname'] ?></h2>
    <p class="username">@<?= $_SESSION["user"]['username'] ?></p>
    <?php /*
    <ul class="list-group list-group-horizontal justify-content-center mb-4">
      <li class="list-group-item"><?= count($posts) ?> Posts</li>
    </ul>
    */ ?>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="posts-tab" data-bs-toggle="tab" data-bs-target="#posts-tab-pane" type="button" role="tab" aria-controls="posts-tab-pane" aria-selected="true"><?= count($posts) ?> Posts</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="liked-tab" data-bs-toggle="tab" data-bs-target="#liked-tab-pane" type="button" role="tab" aria-controls="liked-tab-pane" aria-selected="false"><?= count($likedPosts) ?> Liked</button>
      </li>
    </ul>
  </div>
  <div class="container">
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="posts-tab-pane" role="tabpanel" aria-labelledby="posts-tab" tabindex="0">
        <div class="posts">
        <?php

          if (!empty($posts)) {
            foreach ($posts as $post) {
              ?>
                <a href="/post?id=<?= $post['id'] ?>" class="card">
                  <img src="<?= $post['image'] ?>" class="card-img-top" alt="<?= $post['title'] ?>">
                  <div class="card-body">
                    <div class="d-flex gap-2 justify-content-between">
                      <span><?= $post['date'] ?></span>
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
      <div class="tab-pane fade" id="liked-tab-pane" role="tabpanel" aria-labelledby="liked-tab" tabindex="0">
        <div class="posts">

        <?php

          if (!empty($likedPosts)) {
            foreach ($likedPosts as $post) {
              ?>
                <a href="/post?id=<?= $post['id'] ?>" class="card">
                  <img src="<?= $post['image'] ?>" class="card-img-top" alt="<?= $post['title'] ?>">
                  <div class="card-body">
                    <div class="d-flex gap-2 justify-content-between">
                      <span><?= $post['date'] ?></span>
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
                    </div>
                    <h5 class="card-title"><?= $post['title'] ?></h5>
                  </div>
                </a>
              <?php
            }
          } else {
            ?> <h4>There are no liked posts</h4> <?php
          }
          
          ?>

        </div>
      </div>
    </div>
  </div>
</main>
  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="/assets/js/main.js"></script>
</body>
</html>