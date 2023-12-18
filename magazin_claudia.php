<?php
session_start();
$connect=mysqli_connect("localhost","root","","claudia1");
if (!isset($_SESSION['loggedin'])) {
  header('Location: indexl.html');
  exit;
  }
if(isset($_POST["add_to_cart"]))
{
  if(isset($_SESSION["shopping_cart"]))
  {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if(!in_array($_GET["id"], $item_array_id))
        {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
              'item_id'     => $_GET["id"],
              'item_name'   =>$_POST["hidden_name"],
              'item_price'   =>$_POST["hidden_price"],
              'item_quantity'  =>$_POST["quantity"]
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
        }
        else
        {
             echo '<script>alert("Produs deja adaugat")</script>';
             echo '<script>window.location="magazin_claudia.php"</script>';
        }
  }
  else 
  {
    $item_array = array(
        'item_id'     => $_GET["id"],
        'item_name'   =>$_POST["hidden_name"],
        'item_price'   =>$_POST["hidden_price"],
        'item_quantity'   =>$_POST["quantity"]
    );
    $_SESSION["shopping_cart"][0]=$item_array;
  }
}
if(isset($_GET["action"]))
{
  if($_GET["action"] == 'delete')
  {
    foreach($_SESSION["shopping_cart"] as $keys => $values)
    {
      if($values["item_id"] == $_GET["id"])
      {
        unset($_SESSION["shopping_cart"][$keys]);
        echo '<script>alert("Produs eliminat")</script>';
        echo '<script>window.location="magazin_claudia.php"</script>';
      }
    }
  }
}
?>
<html>
<head>
<title>Cos produse</title>
<link href="style_cart.css" type="text/css" rel="stylesheet" />
</head>
<body>
  <header>
      <div class="menu-area">
       <div class="logo">
          <img src="logo.jpg" alt="">
       </div>
       <ul class="nav-area">
            <li><a href="home_crud">Acasa</a></li>
            <li><a href="about_us.html">Despre noi</a></li>
            <li><a href="magazin_claudia">Produsele noastre</a></li>
            <li><a href="registration.html">Cont nou</a></li>

       </ul>
      </div>
      
</header>
<div id="product-grid">
 <?php
 $query = "SELECT * FROM produse ORDER BY id ASC";
 $result=mysqli_query($connect,$query);
 if(mysqli_num_rows($result)>0)
  {
    while($row = mysqli_fetch_array($result)) 
    {
 ?>
 <div class="cool-md-4">
     <form method="post" action="magazin_claudia.php?action=add&id=<?php echo $row["id"]; ?>">
 <div class="product-image">
    <img src="<?php echo $row["image"]; ?>"></div>
 <h4><?php echo $row["nume"];?></h4>
 <h4 class="product-price"><?php echo "RON ".$row["pret"]; ?></h4>
 <div>
 <input type="text" name="quantity" class="form-control" value="1" />
 <input type="hidden" name="hidden_name" value="<?php echo $row["nume"]; ?>" />
 <input type="hidden" name="hidden_price" value="<?php echo $row["pret"]; ?>" />
 <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
 </div>
     </form>
 </div>
 <?php
 }
 }
 ?>
 <div style = "clear:both"></div>
</br>
<h3>Order Details</h3>
<div class = "table-responsive">
  <table class="table table-bordered">
      <tr>
        <th width="40%">Nume Produs</th>
        <th width="10%">Cantitate</th>
        <th width="20%">Pret</th>
        <th width="15%">Total</th>
        <th width="5%">Actiune</th>
      </tr>
      <?php
      if(!empty($_SESSION["shopping_cart"]))
      {
        $total = 0;
        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
          ?>
               <tr>
                    <td><?php  echo $values["item_name"]; ?></td>
                    <td><?php  echo $values["item_quantity"]; ?></td>
                    <td>RON<?php echo $values["item_price"]; ?></td>
                    <td><?php  echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
                    <td><a href="magazin_claudia.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a><td>
        </tr>
        <?php
            $total = $total + ($values["item_quantity"] * $values["item_price"]);
        }
        ?>
        <tr>
          <td colspan="3" align="right">Total</td>
          <td align="right">RON<?php echo number_format($total, 2); ?></td>
        </tr>
        <?php
      }
      ?>
</table>
<div><a href="Logout.php">Abandonati sesiunea de cumparare</a></div>
</body>
</html>