<?php
    $path = './';
    $page = 'Order Reciept';
    include $path.'assets/inc/header.php';
?>
<h2>Your Pizza Order</h2>
<?php
//
//
$cName = $_POST['customerName'] ;
$cID = $_POST['customerID'] ;
$pSize = $_POST['pizzaSize'] ;
$pTops = $_POST['pizzaToppings'];
//
//
if (empty($cID)) {
    //
    //
    header('Location: orderform.php?ma,e='.$cName);
}else {
    if (!is_numeric($cID)) {
        //
        echo '<p>Customer ID ' . $cID .
        ' is not a valid ID' .
        ' because it contains ' . 
        ' a non-numeric character.</p>';
        //
        echo '<p><form action="orderform.php">'.
        '<input type="hidden" name="name" value="'. $cName .
        '"/><input type="submit" value="ok"/></form></p>';
    } else {
            switch ($pSize){
            case 'P':
                $pizzaCost = 7.99;
                $pizzaType = "Personal";
                break;
            case 'S':
                $pizzaCost = 10.99;
                $pizzaType = "Small";
                break;
            case 'M':
                $pizzaCost = 13.99;
                $pizzaType = "Medium";
                break;
            case "L":
                $pizzaCost = 16.99;
                $pizzaType = "Large";
                break;
            default:
                $pizzaCost = 13.99;
                $pizzaType = "Medium";
            }
            
            switch ($pTops){
            case 'N':
                $topCost = 0;
                break;
            case 'O':
                $topCost = 2.00;
                break;
            case 'T':
                $topCost = 3.00;
                break;
            case 'TH':
                $topCost = 3.75;
                break;
            default:
                $topCost = 0;
            }
        

        //
        $taxAmount = ($pizzaCost + $topCost) * .08;
        $totalCost = $pizzaCost + $topCost + $taxAmount;

        //
        //
        $fmt = numfmt_create( 'en_US', NumberFormatter::CURRENCY );
        //
        //
        ?>
            <div id='receipt'>
            <br/>Your Delicious Pizza Order!!
            <br/>
            <br/>Pizza Price: 
        <?php
            //
            echo numfmt_format_currency($fmt, $pizzaCost, "USD");
            echo "<br>Topping Price: " . numfmt_format_currency($fmt, $topCost, "USD");
            echo "<br>Tax Amount: " . numfmt_format_currency($fmt, $taxAmount, "USD");
            echo "<br>Total Cost of your order is: " . numfmt_format_currency($fmt, $totalCost, "USD");
            echo "<br><br>Thank you for your order";
            echo ($cName == '')? '.': ", $cName.";
            echo"</div>";
        }
    }
?>
</div>

<?php
    include $path.'assets/inc/footer.php';
?>