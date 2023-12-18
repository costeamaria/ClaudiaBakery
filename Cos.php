<?php
require_once "ShoppingCart.php";
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: indexl.html');
    exit;
}
$member_id=$_SESSION['loggedin'];
$shoppingCart = new ShoppingCart();
if (! empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (! empty($_POST["quantity"])) {
                $productResult = $shoppingCart->getProductByCode($_GET["code"]);
                $cartResult = $shoppingCart->getCartItemByProduct($productResult[0]["id"], $member_id);
                if (! empty($cartResult)) {
                    $newQuantity = $cartResult[0]["cos_cantitate"] + $_POST["quantity"];
                    $shoppingCart->updateCartQuantity($newQuantity, $cartResult[0]["id"]);
                } else {
                    $shoppingCart->addToCart($productResult[0]["id"], $_POST["quantity"], $member_id);
                }
            }
            break;
        case "remove":
            $shoppingCart->deleteCartItem($_GET["id"]);
            break;
        case "empty":
            $shoppingCart->emptyCart($member_id);
            break;
    }
}
?>
<HTML>
<HEAD>
    <meta charset="utf-8">
    <TITLE>creare cos permament</TITLE>
    <link href="style_admin.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>
<div class="cart-buttons">
<header>
       <div class="logo">
          <img src="logo.jpg" alt="">
       </div>
</header>
<div id="shopping-cart">
    <div class="txt-heading">
        <div class="txt-heading-label">
            <a id="btnEmpty" href="Cos.php?action=empty"><img src="empty-cart.png" alt="empty-cart" title="Empty Cart" /></a>
            <h1>Cos cumparaturi</h1>
</div>
    </div>
    <?php
    $cartItem = $shoppingCart->getMemberCartItem($member_id);
    if (! empty($cartItem)) {
        $item_total = 0;
        ?>
        <table cellpadding="10" cellspacing="1">
            <tbody>
            <tr>
                <th style="text-align: left;"><strong>Nume produs</strong></th>
                <th style="text-align: left;"><strong>Descriere</strong></th>
                <th style="text-align:right;"><strong>Cantitate</strong></th>
                <th style="text-align:right;"><strong>Pret</strong></th>
                <th style="text-align:center;"><strong>Status</strong></th>
            </tr>
            <?php
            foreach ($cartItem as $item) {
                ?>
                <tr>
                    <td
                            style="text-align: left; border-bottom: #F0F0F0 1px solid;"><strong><?php echo $item["nume"]; ?></strong></td>
                    <td
                            style="text-align: left; border-bottom: #F0F0F0 1px solid;"><?php echo $item["descriere"]; ?></td>
                    <td
                            style="text-align: right; border-bottom: #F0F0F0 1px solid;"><?php echo $item["quantity"]; ?></td>
                    <td
                            style="text-align: right; border-bottom: #F0F0F0 1px solid;"><?php echo $item["pret"]; ?></td>
                    <td
                            style="text-align: center; border-bottom: #F0F0F0 1px solid;"><a href="Cos.php?action=remove&id=<?php echo $item["id"]; ?>" class="btnRemoveAction"><img src="icon-delete.jpg" alt="icon-delete" title="Remove Item" /></a></td>
                </tr>
                <?php
                $item_total += ($item["pret"] * $item["quantity"]);
            }
            ?>
            <tr>
                <td colspan="3"
                    align=right><strong>Total:</strong></td>
                <td align=right><?php echo "RON".$item_total; ?></td>
                <td></td>
            </tr>
            </tbody>
        </table>
        <?php
    }
    ?>
</div>
<a href="magazin_claudia.php">Alegeti alt produs</a></br>
<a href="indexl.html">Abandonati sesiunea de cumparare</a>
</div>
<?php //require_once "product-list.php"; ?>
</BODY>
</HTML>