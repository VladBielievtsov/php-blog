<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="/">Logo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li> -->
      </ul>
      <ul class="navbar-nav ">
        <?php
          if ($_SESSION['user'] && $_SESSION['user']['group'] === "2") {
            ?>
            <li class="nav-item">
              <a class="nav-link" href="/admin">Admin</a>
            </li>
            <?php
          }
          if (!$_SESSION["user"]) {
            ?>
              <li class="nav-item me-4">
                <a class="nav-link" href="/login">Sign in</a>
              </li>
              <li class="nav-item">
                <a class="btn btn-primary" href="/register">Sign up</a>
              </li>
              <?php
          } else {
            ?>
              <li class="nav-item">
                <a class="nav-link" href="/profile">Profile</a>
              </li>
              <li class="nav-item">
                <form action="/auth/logout" method="post">
                  <button type="submit" class="nav-link">Logout</button>
                </form>
              </li>
              <li class="nav-item" style="margin-left: 24px;">
                <form id="searchUserForm" method="GET" action="/users" class="d-flex" role="search">
                  <input id="searchUserInput" name="username" class="form-control me-2" type="search" placeholder="Search user" aria-label="Search">
                  <button class="btn btn-outline-success" style="margin-left: 8px;" type="submit">Search</button>
                </form>
              </li>
              <li class="nav-item" style="margin-left: 24px;">
                <a href="/add-post" class="btn btn-primary">Add Post</a>
              </li>
            <?php
          }
        ?>
      </ul>
    </div>
  </div>
</nav>