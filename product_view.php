<?php
include 'partials/_dbconnect.php';
include 'partials/eheader.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid product ID.";
    exit;
}

$productId = (int)$_GET['id'];

$productSql = "SELECT * FROM tbl_products WHERE product_id = $productId LIMIT 1";
$productResult = mysqli_query($conn, $productSql);

if (!$productResult || mysqli_num_rows($productResult) == 0) {
    echo "Product not found.";
    exit;
}

$product = mysqli_fetch_assoc($productResult);

$imageSql = "SELECT image_path FROM product_images WHERE product_id = $productId";
$imageResult = mysqli_query($conn, $imageSql);
$images = [];
if ($imageResult && mysqli_num_rows($imageResult) > 0) {
    while ($row = mysqli_fetch_assoc($imageResult)) {
        $images[] = 'images_folder/' . $row['image_path'];
    }
}
if (empty($images)) {
    $images[] = 'images_folder/no-image.jpg';
}
$imagePath = $images[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($product['product_name']) ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
</head>
<body>

<div class="container my-5 product_data">
  <div class="row">
    <div class="col-md-6">
      <img id="mainImage" src="<?= htmlspecialchars($imagePath) ?>" alt="Product Image" style="width:100%; height:400px; object-fit:cover; border-radius:8px; border:1px solid #ccc;">

      <?php if (count($images) > 1): ?>
      <div style="display:flex; gap:10px; margin-top:15px; flex-wrap:wrap;">
        <?php foreach ($images as $index => $img): ?>
          <img src="<?= htmlspecialchars($img) ?>" alt="Thumbnail <?= $index + 1 ?>"
               style="width:80px; height:80px; object-fit:cover; border-radius:5px; border:2px solid #ddd; cursor:pointer; transition:all 0.3s;"
               class="thumbnail-img"
               onclick="changeMainImage('<?= htmlspecialchars($img) ?>')">
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>

    <div class="col-md-6">
    <h2><?= htmlspecialchars($product['product_name']) ?></h2>
<p><?= nl2br(htmlspecialchars($product['product_description'])) ?></p>
<h4 class="text-success">$<?= htmlspecialchars($product['product_price']) ?></h4>



      <div class="input-group mb-3" style="width:130px;">
        <button class="input-group-text decreament-btn">-</button>
        <input type="text" class="form-control bg-white text-center qty-input" value="1" readonly>
        <button class="input-group-text increament-btn">+</button>
      </div>

<button class="btn btn-primary add-to-cart-btn" data-id="<?= $product['product_id'] ?>">🛒 Add to Cart</button>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
function changeMainImage(imagePath) {
  document.getElementById('mainImage').src = imagePath;
  document.querySelectorAll('.thumbnail-img').forEach(img => {
    img.style.border = '2px solid #ddd';
  });
  event.target.style.border = '2px solid #007bff';
}

$('.increament-btn').click(function(){
  var qty = $('.qty-input');
  var value = parseInt(qty.val());
  if (value < 10) qty.val(value + 1);
});

$('.decreament-btn').click(function(){
  var qty = $('.qty-input');
  var value = parseInt(qty.val());
  if (value > 1) qty.val(value - 1);
});

$('.add-to-cart-btn').click(function(){
  var prod_id = $(this).data('id');
  var qty = $('.qty-input').val();

  $.post('handleCart.php', { prod_id: prod_id, prod_qty: qty, scope: 'add' }, function(response){
    if (response == 201) {
      alertify.success('Product added to cart');
    } else if (response == 401) {
      alertify.error('Please login first');
      setTimeout(()=> window.location.href='user_login.php', 1000);
    } else {
      alertify.error('Error: ' + response);
    }
  });
});
</script>

<?php include 'partials/efooter.php'; ?>
</body>
</html>
