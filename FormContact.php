<?php  

$myname = $firstname = $mail = $number = $city = $county = $zone = $address = $command = $price = $amount = $total = " ";
$nomError = $prenomError = $mailError = $numberError = $cityError = $countyError = $zoneError = $addressError = " ";
$isSuccess = false;
$emailTo = "abdoul-fatao_p23@ifi.edu.vn";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  $myname = verify_input($_POST["myname"]);
  $firstname = verify_input($_POST["firstname"]);
  $mail = verify_input($_POST["mail"]);
  $number = verify_input($_POST["number"]);
  $city = verify_input($_POST["city"]);
  $county = verify_input($_POST["county"]);
  $zone = verify_input($_POST["zone"]);
  $address = verify_input($_POST["address"]);
  $command = verify_input($_POST["command"]);
  $price = verify_input($_POST["price"]);
  $amount = verify_input($_POST["amount"]);
  $total = verify_input($_POST["total"]);
  $isSuccess = true;
  $emailText = "";


  if(empty($myname)){
    $nomError = 'Ce champ ne peut pas etre vide';
    $isSuccess = false;
  }
  else{
    $emailText .="Name: $myname\n";
  }
//
  if(empty($firstname)){
    $prenomError = 'Ce champ ne peut pas etre vide';
    $isSuccess = false;
  }
  else{
    $emailText .="Firstname: $firstname\n";
  }
//
  if(!isEmail($mail)){
    $mailError = 'Email incorrect';
    $isSuccess = false;
  }
  else{
    $emailText .="Email: $mail\n";
  }
//

  if(empty($number)){
    $numberError = 'Veuillez saisir un numero de telephone';
    $isSuccess = false;
  }
  else{
    $emailText .="Number: $number\n";
  }
//
  if(empty($city)){
    $cityError = 'Ce champ ne peut pas etre vide';
    $isSuccess = false;
  }
  else{
    $emailText .="City: $city\n";
  }
  //
  if(empty($county)){
    $countyError = 'Ce champ ne peut pas etre vide';
    $isSuccess = false;
  }
  else{
    $emailText .="County: $county\n";
  }
  //
  if(empty($zone)){
    $zoneError = 'Ce champ ne peut pas etre vide';
    $isSuccess = false;
  }
  else{
    $emailText .="Zone: $zone\n";
  }
  //
  if(empty($address)){
    $addressError = 'Ce champ ne peut pas etre vide';
    $isSuccess = false;
  }
  else{
    $emailText .="Address: $address\n";
  }

  if($isSuccess){
    $headers = "From: $firstname $myname <$mail>\r\nReply-To: $mail";
    mail($emailTo, "Commande", $emailText, $headers);
    $myname = $firstname = $mail = $number = $city = $county = $zone = $address = $command = $price = $amount = $total = " ";
  }




}

function isPhone($var){

  return preg_match("/^[0-9]*$/", $var);
}

function isEmail($var){

  return filter_var($var, FILTER_VALIDATE_EMAIL);

}
//Securite des donnees avec htmlspecialchars
function verify_input($data)
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
  <title>bootstrap</title>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css.css">

</head>
    <body>
          <div  class="container">
          <h1 class="header" id="entete"><span class="glyphicon glyphicon-cutlery"></span> Restaurant Rii Noodo
                    <span class="glyphicon glyphicon-cutlery"></span>
          </h1>
            <div class="red-devider"></div>
             <div class="heading">
              <h3><a href="acceuil.php"><span class="glyphicon glyphicon-home"></span> HOME</a> <br/><br/>REMPLIR LE FORMULAIRE DE COMMMANDE</h3>
            </div>

               <div class="col-lg-10 col-lg-offset-1">
                  <form id="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" role="form">
                      <div class="row">
                         <div class="col-md-6">
                          <label for="myname">Name</label>
                          <input type="text" id="myname" name="myname" class="form-control" placeholder="Enter your name" value="<?php echo $myname; ?>">
                          <p class="comment"><?php echo $nomError; ?></p>
                          </div>

                        <div class="col-md-6">
                         <label for="firstname">First-Name</label>
                         <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Enter your fisrt-name" value="<?php echo $firstname; ?>">
                          <p class="comment"><?php echo $prenomError; ?></p>
                       </div>

                       <div class="col-md-6">
                        <label for="mail">E-mail</label>
                        <input type="email" id="mail" name="mail" class="form-control" placeholder="Enter your address E-mail" value="<?php echo $mail; ?>">
                        <p class="comment"><?php echo $mailError; ?></p>
                      </div>

                      <div class="col-md-6">
                       <label for="number">Number</label>
                       <input type="tel" id="number" name="number" class="form-control" placeholder="Enter your telephone number" value="<?php echo $number; ?>">
                       <p class="comment"><?php echo $numberError; ?></p>
                     </div>

                      <div class="col-md-6">
                        <label for="city">City </label>
                        <input type="text" id="city" name="city" class="form-control" placeholder="Enter your city name" value="<?php echo $city; ?>">
                        <p class="comment"><?php echo $cityError; ?></p>
                       </div>

                       <div class="col-md-6">
                         <label for="county">County</label>
                         <input type="text" id="county" name="county" class="form-control" placeholder="Enter your county name" value="<?php echo $county; ?>">
                         <p class="comment"><?php echo $countyError; ?></p>
                        </div>

                        <div class="col-md-6">
                          <label for="zone">Zone</label>
                          <input type="text" id="zone" name="zone" class="form-control" placeholder="Enter your zone" value="<?php echo $zone; ?>">
                          <p class="comment"><?php echo $zoneError; ?></p>
                         </div>

                         <div class="col-md-6">
                           <label for="address">Address</label>
                           <input type="text" id="address" name="address" class="form-control" placeholder="Enter your address" value="<?php echo $address; ?>">
                           <p class="comment"><?php echo $addressError; ?></p>
                          </div>

                          <div class="col-md-6">
                            <label for="command">Command</label>
                            <input type="text" id=command name="command" class="form-control" placeholder="commande" <?php echo $command; ?> >

                           </div>

                           <div class="col-md-6">
                             <label for="price">Price</label>
                             <input type="number" id="price"  name="price" class="form-control" placeholder="Price" <?php echo $price; ?> >
                            </div>

                            <div class="col-md-6">
                              <label for="amount">Amount</label>
                              <input type="number" id="amount" step="0.5" name="amount" class="form-control" placeholder="Amount" <?php echo $amount; ?> >
                             </div>

                             <div class="col-md-6">
                               <label for="total">Total</label>
                               <input type="text" id="total" name="total" class="form-control" placeholder="total" <?php echo $total; ?> >
                             </div>
                             <br/>
                             <div class="col-md-6">
                               <input type="submit"  class="button1" value="Send">
                             </div>



                      </div>
                      <p  class="thanks" style="display:<?php if($isSuccess) echo "Block"; else echo "none";?>"> Your message is send !!!</p>
                </form>

            </div>

    </body>
</html>
