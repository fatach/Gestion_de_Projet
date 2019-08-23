<?php

      require "database.php";
      $nameError = $descriptionError = $priceError = $categoryError = $imageError = "";
      $name = $description = $price = $category = $image = "";

      if (!empty($_POST))

      {
          $name = test_input($_POST['name']);
          $description = test_input($_POST['description']);
          $price = test_input($_POST['price']);
          $category = test_input($_POST['category']);
          $image = test_input($_FILES['image']['name']);
          $imagePath         = '../images/' . basename($image);
          $imageExtension    = pathinfo($imagePath,PATHINFO_EXTENSION);
          $isSuccess         = true;
          $isUploadSuccess   = false;

          if(empty($name)){
            $nameError = 'Ce champ ne peut pas etre vide';
            $isSuccess = false;
          }
          if(empty($description)){
            $descriptionError = 'Ce champ ne peut pas etre vide';
            $isSuccess = false;
          }
          if(empty($price)){
            $priceError = 'Ce champ ne peut pas etre vide';
            $isSuccess = false;
          }
          if(empty($category)){
            $categoryError = '';
            $isSuccess = false;
          }
          if(empty($image)){
            $imageError = 'Ce champ ne peut pas etre vide';
            $isSuccess = false;
          }
          else {
                  $isUploadSuccess = true;
                  if($imageExtension !="jpg" && $imageExtension !="png" && $imageExtension !="jpeg" && $imageExtension !="gif")
                  {
                    $imageError = "Les fichiers autorises sont: .jpg, .jpeg, .png, .gif";
                    $isUploadSuccess = false;
                  }
                  if(file_exists($imagePath))
                  {
                    $imageError = "Le fichier existe deja";
                    $isUploadSuccess = true;
                  }
                  if($_FILES["image"]["size"] >5000000000)
                  {
                    $imageError = "Le fichier ne doit pas depasser les 500kb";
                    $isUploadSuccess = false;
                  }
                  if($isUploadSuccess)
                  {
                    if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath))
                    {
                      $imageError = "Il y a eu une erreur lors de l'upload";
                      $isUploadSuccess = false;
                    }
                  }

          }
          if($isSuccess && $isUploadSuccess)
          {
            $db = Database::connect();
            $statement = $db->prepare("INSERT INTO items(name,description,price,category,image) values(?,?,?,?,?)");
            $statement->execute(array($name,$description,$price,$category,$image));
            Database::disconnect();
            header("Location: index.php");
          }

      }
//Securite des donnees avec htmlspecialchars
            function test_input($data)
      {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
      }





?>

<!DOCTYPE html>
<html>
  <head>
    <title>
    </title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../style.css">
  </head>

  <body>
    <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Restaurant Rii Noodo
      <span class="glyphicon glyphicon-cutlery"></span>
     </h1>
      <div class="container admin">
        <div class="row">
          <h1><i>Ajouter un item</i></h1>
            <br/><br/>
            <form class="form" role="form" action="insert.php" method="post" enctype="multipart/form-data">
               <div class="form-group">
                <label for="name">Nom:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name; ?>">
                <span class="help-inline"><?php echo $nameError; ?></span>
              </div>
              <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description; ?>">
                <span class="help-inline"><?php echo $descriptionError; ?></span>
               </div>
               <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" step="0.5" class="form-control" id="price" name="price" placeholder="Prix" value="<?php echo $price; ?>">
                <span class="help-inline"><?php echo $priceError; ?></span>
               </div>
               <div class="form-group">
                <label for="category">Categorie:</label>
                  <select class="form-control" id="category" name="category">
                    <?php
                       $db = Database::connect();
                       foreach ($db->query('SELECT * FROM categories') as $row )
                       {
                         echo '<option value="' .$row['id'] . '">' . $row['name'] . '</option>';
                        }
                       Database::disconnect();
                   ?>
                </select>
                <span class="help-inline"><?php echo $categoryError; ?></span>
             </div>
             <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" >
                <span class="help-inline"><?php echo $imageError; ?></span>
               </div>
            <br/>
            <div class="form-action">
              <button type="submit" value="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>Ajouter</button>
              <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"> Retour</a>
           </div>
        </form>
       </div>
    </div>
</body>
</html>
