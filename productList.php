<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Scansiweb</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 

</head>

<body>

 <?php
require './Conn2.php';
require './User.php';

$formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($formData['SendAddUser'])) {
  $createUser = new User();
  $createUser->formData = $formData;

  // Checking if the SKU already exists in the database
  $existingSKU = $createUser->formData['sku'];
  if (skuExistsInDatabase($existingSKU)) {
    echo "<p style='color: #f00; font-size:1.2rem; background: linear-gradient(to right, black, gray);'>Error: SKU already exists in the database!</p>";
  } else {
    $value = $createUser->index();

    if ($value) {
      header("Location: index.php");
    } else {
      echo "<p style='color: #f00;'>Error!</p>";
    }
  }
}

function skuExistsInDatabase($sku) {
  // Replacing with the database connection code
  $conn = new mysqli("localhost", "u986902309_roger1", "Roger*2024", "u986902309_roger");

  // Checking if the connection was successful
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Preparing and executing a query to check if the SKU already exists
  $stmt = $conn->prepare("SELECT COUNT(*) FROM users3 WHERE sku = ?");
  $stmt->bind_param("s", $sku);
  $stmt->execute();
  $stmt->bind_result($count);
  $stmt->fetch();
  $stmt->close();

  // Return true if the SKU exists, false otherwise
  return $count > 0;
}
?>
  <form id="product_form" name="CreateUser" method="POST" action="">


    <div class="head1">

      <div>

        <h1>ADD PRODUCT</h1>

      </div>


      <div class="buttons">
        <input href="index.php" type="submit" value="Save" name="SendAddUser" />
        <input type="reset" value="CANCEL">
      </div>

    </div>

    <div class="main">

    <div class="form-group">
      <label>SKU: </label>
      <input id="sku" type="text" name="sku" placeholder="" required /><br><br>
      </div>

      <div class="form-group">
      <label>Name: </label>
      <input id="name" type="text" name="name" placeholder="" required /><br><br>
      </div>

      <div class="form-group">
      <label>Price: </label>
      <input id="price" type="price" name="price" placeholder="" required /><br><br><br>
      </div>

      <div class="form-group">
      <label for="">Type Switcher</label>
      <select required name="productType" id="productType" style="width: 160px;">
      <option value="" disabled="" selected="">Type Switcher</option>
        <option value="DVD">DVD</option>
        <option value="Book">Book</option>
        <option value="Furniture">Furniture</option>
      </select>
      </div>

    </div>

  </form>
  <script>
  
  
  $('#productType').change(function() {
  const elements = {
    DVD: {
      containerId: 'product-description-dvd',
      html: '<p style="margin-bottom: 10px; margin-left: 15px; color:white;"><b>Please, provide size</b></p>\n' +
        '<div style="margin-left: 15px;" class="form-group" id="dvd">\n' +
        '  <label style="color:white;" for="size">Size (MB)</label>\n' +
        '  <input required name="size" type="number" id="size">\n' +
        '</div>'
    },
    Book: {
      containerId: 'product-description-book',
      html: '<p style="margin-bottom: 10px; margin-left: 15px; color:white;"><b>Please, provide weight</b></p>\n' +
        '<div style="margin-left: 15px;" class="form-group" id="book">\n' +
        '  <label style="color:white;" for="weight">Weight (KG)</label>\n' +
        '  <input required type="number" id="weight" name="weight">\n' +
        '</div>'
    },
    Furniture: {
      containerId: 'product-description-furniture',
      html: '<p style="margin-bottom: 10px; margin-left: 15px; color:white;"><b>Please, provide dimensions</b></p>\n' +
        '<div style="color:white; margin-left:15px;" class="form-group" id="furniture">\n' +
        '  <label for="height"> Height: </label>\n' +
        '  <input required type="number" id="height" name="dimension1" style="margin-right: 10px; width:90px;"> <br>\n' + 
        '  <label for="width"> Width: </label>\n' +
        '  <input required type="number" id="width" name="dimension2"  style="margin-right: 10px;width:90px;"> <br>\n' +
        '  <label for="length"> Length: </label>\n' +
        '  <input required type="number" id="length" name="dimension3" style="width:90px;">\n' +
        '</div>'
    }
  };


  Object.values(elements).forEach(({ containerId }) => {
    $(`#${containerId}`).remove();
  });

  const selectedValue = $(this).val();
  if (selectedValue in elements) {
    const { containerId, html } = elements[selectedValue];
    $('#product_form').append(`<div id="${containerId}">${html}</div>`);
  }
});


  </script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="/productList.php/jquery.js"></script>





</body>

</html>
