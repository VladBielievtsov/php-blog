<?php
 use App\Services\Page;

 if (!$_SESSION["user"]) {
  \App\Services\Router::redirect('/login');
 }
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
  <?php
    Page::part('Head');
    ?>

  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        
  <script>
    tinymce.init({
    selector: 'textarea#editor',
    skin: 'bootstrap',
    plugins: 'lists, link, image, media',
    toolbar: 'h1 h2 h3 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
    menubar: false,
    setup: (editor) => {
      // Apply the focus effect
      editor.on("init", () => {
      editor.getContainer().style.backgroundColor = "#222529"  
      editor.getContainer().style.transition = "border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out";
      });
      editor.on("focus", () => { (editor.getContainer().style.boxShadow = "0 0 0 .2rem rgba(0, 123, 255, .25)"),
      (editor.getContainer().style.borderColor = "#80bdff");
        });
      editor.on("blur", () => {
      (editor.getContainer().style.boxShadow = ""),
      (editor.getContainer().style.borderColor = "");
       });
     },
  });
  </script>
</head>
<body>
  
<?php
  Page::part('Nav');
?>

<main>
  <div class="container">
    <h1 class="mt-4">Add Post</h1>
    <form class="mt-4" action="/post/add" method="post" enctype="multipart/form-data">

      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" class="form-control" id="title">
      </div>
      <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" name="image" class="form-control" id="image">
      </div>
      <div class="mb-3">
        <label for="editor" class="form-label">Content</label>
        <!-- <textarea name="content" id="content" class="form-control" cols="30" rows="10"></textarea> -->
        <textarea name="content" class="form-control" cols="30" rows="10" id="editor"></textarea>
      </div>
      
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</main>
  
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js" integrity="sha512-BmM0/BQlqh02wuK5Gz9yrbe7VyIVwOzD1o40yi1IsTjriX/NGF37NyXHfmFzIlMmoSIBXgqDiG1VNU6kB5dBbA==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>