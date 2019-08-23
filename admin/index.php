<!DOCTYPE html>
<html>
  <head>
    <title>Page d_administration
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
          <h4><a href="../acceuil.php"><span class="glyphicon glyphicon-home"></span> HOME</a></h4>
          <h3><strong> Liste des items</strong> <a class="btn btn-success" href="insert.php"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h3>
          <!---Creation d'une table---->
          <table class="table table-striped table-bordered">
               <thead>
                 <tr>
                   <th>Nom</th>
                   <th>Description</th>
                   <th>Prix</th>
                   <th>Categorie</th>
                   <th>Action</th>
                 </tr>
              </thead>
               <tbody>
                 <?php
                    require "database.php";
                    $db = Database::connect();
                    $statement = $db->query('SELECT items.id,items.name, items.description,items.price,categories.name AS category
                    FROM items LEFT JOIN categories ON items.category = categories.id
                    ORDER BY items.id DESC');
                    while($item = $statement->fetch())
                    {
                      echo '<tr>';
                      echo '<td>' . $item['name'] . '</td>';
                      echo '<td>' . $item['description'] . '</td>';
                      echo '<td>' . number_format((float)$item['price'],2,'.','') . '</td>';
                      echo '<td>' . $item['category'] . '</td>';
                      echo '<td width=300>';
                      echo '<a class="btn btn-default" href="view.php?id=' .$item['id'] . '"><span class="glyphicon glyphicon-eye-open"></span>Voir</a>';
                      echo ' ';
                      echo '<a class="btn btn-primary" href="update.php?id=' . $item['id'] . '"><span class="glyphicon glyphicon-pencil"></span>Modifier</a>';
                      echo ' ';
                      echo '<a class="btn btn-danger" href="delete.php?id=' . $item['id'] . '"><span class="glyphicon glyphicon-remove"></span>Supprimer</a>';
                      echo '</td>';
                      echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
              </tbody>
          </table>

        </div>
      </div>


  </body>
  </html>
