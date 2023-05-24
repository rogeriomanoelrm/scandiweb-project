<link rel="stylesheet" href="style.css">

<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Scandiweb</title>
</head>

<body class="list1">



    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }

    require './Conn2.php';
    require './User.php';

    $listUsers = new User();
    $result_users = $listUsers->list();
    ?>

 
               
           <div class="head2">

        <h1>Product List</h1>

        <div class="head2buttons">

            <a href="productList.php"><button id="pladdbtn">ADD</button></a>

            <form method="post" action="delete.php">

            <button class="delete-product-btn" class="delete-product-btn" href="#">MASS DELETE</button>

        </div>

    </div>

        <?php
        $dimension1 = isset($_POST['dimension1']) ? $_POST['dimension1'] : '';
        $dimension2 = isset($_POST['dimension2']) ? $_POST['dimension2'] : '';
        $dimension3 = isset($_POST['dimension3']) ? $_POST['dimension3'] : '';
        $weight = isset($_POST['weight']) ? $_POST['weight'] : '';
        $size = isset($_POST['size']) ? $_POST['size'] : '';

        ?>



        <div class="father">
            <?php foreach ($result_users as $row_user) {
                extract($row_user);
                if (!empty($dimension1 && $dimension2 && $dimension3) || !empty($weight) || !empty($size)) {
            ?>
                    <div class="son">

                        <div class="check">
                            <input class="delete-checkbox" id="delete-checkbox" type="checkbox" name="delete[]" value="<?php echo $id ?>">
                        </div>

                        <div class="size">

                            <p>SKU: <?php echo $sku ?></p>
                            <p>Name: <?php echo $name ?></p>
                            <p>Price: <?php echo $price ?> $</p>
                            <?php if (!empty($dimension1 && $dimension2 && $dimension3)) { ?>
                                <p><?php echo 'Dimension: ' . $dimension1 . 'x' . $dimension2 . 'x' . $dimension3 ?></p>
                            <?php } ?>
                            <?php if (!empty($weight)) { ?>
                                <p><?php echo 'Weight(kg): ' . $weight ?></p>
                            <?php } ?>
                            <?php if (!empty($size)) { ?>
                                <p><?php echo 'Size(mb): ' . $size ?></p>
                            <?php } ?>

                        </div>


                    </div>

                    <?php
        } 
    } 
    ?>
         
        </div>

    </form>
    
        <script>
        $("#delete-product-btn").click(function(e){
         e.preventDefault();
         $("#delete").click();
       });
    </script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="/productList.php/jquery.js"></script>


</body>

</html>

   