<?php
   require 'database.php';

   if (!empty($_GET['id'])) {
     $id = checkInput($_GET['id']);
   }
if (!empty($_POST['id']))
{
  $id = checkInput($_POST['id']);
  $db = Database::connect();
  $statement = $db->prepare("DELETE FROM items WHERE id = ?");
  $statement->execute(array($id));
  Database::disconnect();
  header("Location: index.php");
}


//Controle de securite
   function checkInput($data)
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
            <h1><i>Suppimer un item</i></h1>
            <br><br>
            <form class="form" action="delete.php" method="post">
              <input type="hidden" name="id" value="<?php echo $id; ?>"/>
              <p class="alert alert-warning">
                Etes vous sure de vopuloir supprimer cette ligne?
              </p>


              <div class="form-action">
                   <button type="submit"  class="btn btn-warning">Oui</button>
                   <a class="btn btn-default" href="index.php">Non</a>
              </div>
         </form>
       </div>
     </div>
</body>
</html>
