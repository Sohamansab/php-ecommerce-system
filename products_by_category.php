<?php
include 'partials/_dbconnect.php';

$categories = [
    1 => ['name' => 'Electronics', 'emoji' => '📱'],
    2 => ['name' => 'Fashion', 'emoji' => '👗'],
    3 => ['name' => 'Home & Kitchen', 'emoji' => '🏠'],
    4 => ['name' => 'Books', 'emoji' => '📚'],
    5 => ['name' => 'Beauty', 'emoji' => '💄'],
    6 => ['name' => 'Toys', 'emoji' => '🧸'],
    7 => ['name' => 'Grocery', 'emoji' => '🛒']
];
?>

<style>
  .category-title { 
    font-size: 28px; 
    text-align: center; 
    margin-top: 40px; 
    font-weight: bold; 
  }
  .category-container { 
    margin-bottom: 60px; 
  }
  .scroll-wrapper { 
    position: relative; 
    padding: 10px 50px; 
    max-width: 1100px; 
    margin: 0 auto; 
  }
  .product-scroll-wrapper { 
    overflow-x: auto; 
    white-space: nowrap; 
    scroll-behavior: smooth; 
    -ms-overflow-style: none; 
    scrollbar-width: none; 
  }
  .product-scroll-wrapper::-webkit-scrollbar { 
    display: none; 
  }
  .product-card { 
    display: inline-block; 
    width: 230px; 
    margin-right: 10px; 
    border: 1px solid #ccc; 
    border-radius: 10px; 
    padding: 15px; 
    background: #fff; 
    text-align: center; 
    box-shadow: 0 0 5px rgba(0,0,0,0.1); 
    transition: transform 0.2s; 
  }
  .product-card:hover { 
    transform: scale(1.03); 
  }
  .product-card img { 
    width: 100%; 
    height: 180px; 
    object-fit: cover; 
    border-radius: 10px; 
  }
  .product-name { 
    font-size: 18px; 
    font-weight: bold; 
    margin-top: 10px; 
  }
  .product-desc { 
    font-size: 14px; 
    color: #666; 
    margin: 10px 0; 
  }
  .product-price { 
    font-size: 16px; 
    font-weight: bold; 
    margin-bottom: 10px; 
  }
  .add-to-cart { 
    background-color: #007bff; 
    color: white; 
    padding: 10px 20px; 
    font-size: 14px; 
    border: none; 
    border-radius: 6px; 
    cursor: pointer; 
    margin-top: 10px; 
  }
  .add-to-cart:hover { 
    background-color: #0056b3; 
  }

  /* Scroll Buttons */
  .scroll-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    font-size: 40px;
    background: none;
    border: none;
    cursor: pointer;
    color: #333;
    z-index: 10;
    user-select: none;
    padding: 0 10px;
    transition: color 0.3s ease;
  }
  .scroll-btn:hover {
    color: #007bff;
  }
  .scroll-left {
    left: 0;
  }
  .scroll-right {
    right: 20px;
  }
</style>

<?php foreach ($categories as $categoryId => $category): ?>
  <?php
$sql = "SELECT p.product_id, p.product_name, p.product_description AS description, p.product_price AS price,
        (SELECT image_path FROM product_images WHERE product_id = p.product_id LIMIT 1) AS image_path
        FROM tbl_products p 
        WHERE p.category_id = $categoryId 
        ORDER BY p.product_id DESC";

$result = mysqli_query($conn, $sql);
?>

  <div class="category-container">
    <div class="category-title"><?= $category['emoji'] . ' ' . htmlspecialchars($category['name']) ?></div>

    <div class="scroll-wrapper">
      <!-- Left scroll button -->
      <button class="scroll-btn scroll-left" onclick="scrollCategory('scroll-<?= $categoryId ?>', -1)">&#10094;</button>

      <div class="product-scroll-wrapper" id="scroll-<?= $categoryId ?>">
        <?php if ($result && mysqli_num_rows($result) > 0): ?>
          <?php while ($product = mysqli_fetch_assoc($result)):
              $image = $product['image_path'] ? 'images_folder/' . $product['image_path'] : 'images_folder/no-image.jpg';
          ?>
<a href="product_view.php?id=<?= $product['product_id'] ?>" style="text-decoration: none; color: inherit;">
  
         
  
         <div class="product-card">
    <img src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($product['product_name']) ?>">
    <div class="product-name"><?= htmlspecialchars($product['product_name']) ?></div>
    <div class="product-desc"><?= htmlspecialchars(substr($product['description'], 0, 30)) ?>...</div>
    <div class="product-price">$<?= htmlspecialchars($product['price']) ?></div>
    
    <button class="add-to-cart">🛒 Add to Cart</button>
  </div>
</a>

          <?php endwhile; ?>
        <?php else: ?>
          <p style="text-align:center;">No <?= htmlspecialchars($category['name']) ?> products found.</p>
        <?php endif; ?>
      </div>

      <!-- Right scroll button -->
      <button class="scroll-btn scroll-right" onclick="scrollCategory('scroll-<?= $categoryId ?>', 1)">&#10095;</button>
    </div>
  </div>
<?php endforeach; ?>

<script>
  function scrollCategory(containerId, direction) {
    const container = document.getElementById(containerId);
    const cardWidth = 270; // width + margin
    container.scrollBy({
      left: direction * cardWidth,
      behavior: 'smooth'
    });
  }
</script>
