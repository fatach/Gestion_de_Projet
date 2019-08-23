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
    <link rel="stylesheet" href="style.css">
  </head>

  <body>
         <div class="container site ">
                  <h1 class="text-logo" id="entete"><span class="glyphicon glyphicon-cutlery"></span> Restaurant Rii Noodo
                    <span class="glyphicon glyphicon-cutlery"></span><br/>
                  </h1>
                  <p class="contact"><span class="glyphicon glyphicon-phone-alt"> 0936148512
                  <a href="reservation.php" >Reservation</a></p>
        <?php
          require 'admin/database.php';
          echo '<nav>

                    <ul class="nav nav-pills">';
            $db = Database::connect();
            $statement = $db->query('SELECT * FROM categories');
            $categories = $statement->fetchAll();
            foreach ($categories as $category)

            {
                if($category['id'] == '1')
                  echo '<li role="presentation" class="active"><a href="#' .$category['id'] . '" data-toggle="tab">' .$category['name'].'</a></li>';
                else
                  echo '<li role="presentation"><a href="#' .$category['id'] . '" data-toggle="tab">' .$category['name'].'</a></li>';
            }
            echo '</ul>
                </nav>';

           echo '<div class="tab-content">';

           foreach ($categories as $category)
           {
              if($category['id'] == '1')
                  echo '<div class="tab-pane active" id="' .$category['id'] . '">';
              else
                  echo '<div class="tab-pane" id="' .$category['id'] . '">';


           echo ' <div class="row">';

             $statement = $db->prepare('SELECT * FROM items WHERE items.category = ?');
             $statement->execute(array($category['id']));

             while($item = $statement->fetch())
              {
                echo '<div class="col-sm-6 col-md-4">
                         <div class="thumbnail">
                            <img src="images/' . $item['image']. '" alt="..."/>
                            <div class="price">' . number_format($item['price'], 2, '.', ''). '$ </div>
                            <div class="caption">
                                <h4> '. $item['name'] . '</h4>
                                <p> '. $item['description'] . '</p>
                                <a href="FormContact.php"
                                class="btn btn-order" role="button">
                                <span class="glyphicon glyphicon-shopping-cart">
                                  </span>  Command</a>
                           </div>
                     </div>
                </div>';

              }
              echo '</div>
                  </div>';

            }
            Database::disconnect();
            echo '</div>';
         ?>
        </div>
        <div class="footer">
          <a href="#entete"><span class="glyphicon glyphicon-chevron-up"></span>  </a>
          <h5> Copyright 2019 by Abdoul-Fatao Ouedraogo</h5>
        </div>
    </body>
</html>
