<?php
include 'partials/_dbconnect.php'; 
include 'partials/eheader.php'; 

$categories = [];
$sql = "SELECT * FROM categories";
$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

$sql_hot = "SELECT p.product_id, p.product_name, p.product_description AS description, p.product_price AS price,
            (SELECT image_path FROM product_images WHERE product_id = p.product_id LIMIT 1) AS image_path
        FROM tbl_products p
        WHERE p.isHotSale = 1
        ORDER BY p.product_id DESC
        LIMIT 10";

$result_hot = mysqli_query($conn, $sql_hot);
?>

<style>
  /* ==== GLOBAL UI UPGRADE ==== */
body {
  font-family: 'Poppins', sans-serif;
  background: #f5f7fb;
  margin: 0;
  padding: 0;
}

* {
  transition: 0.3s ease;
}

/* ==== CAROUSEL ===== */
.carousel {
  width: 92%;
  max-width: 1300px;
  height: 450px;
  margin: 60px auto;
  border-radius: 18px;
  overflow: hidden;
  position: relative;
  box-shadow: 0 10px 35px rgba(0,0,0,0.15);
}

.carousel-inner img {
  width: 100%;
  height: 100%;
  display: none;
  position: absolute;
  object-fit: cover;

  opacity: 0;
  transform: scale(1.05);
}

.carousel-inner img.active {
  display: block;
  opacity: 1;
  transform: scale(1);
}

.controls .btn {
  background: rgba(0,0,0,0.5);
  padding: 12px 20px;
  border-radius: 50px;
  font-size: 22px;
  backdrop-filter: blur(4px);
}

.controls .btn:hover {
  background: rgba(0,0,0,0.8);
}

.pagination .dot {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background: rgba(255,255,255,0.5);
  border: none;
}

.dot.active {
  background: #fff;
  transform: scale(1.3);
}

/* ==== HOT SELLING TITLE ====== */
.category-title {
  font-size: 34px;
  font-weight: 700;
  text-align: center;
  margin-bottom: 30px;

  background: linear-gradient(45deg, #ff4d4d, #ff9900);
  -webkit-background-clip: text;
  color: transparent;
}

/* ==== SLIDER WRAPPER ==== */
.scroll-wrapper {
  position: relative;
  padding: 20px 60px;
}

.scroll-btn {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  font-size: 45px;
  background: #fff;
  border-radius: 50%;
  border: none;
  width: 55px;
  height: 55px;
  box-shadow: 0 8px 18px rgba(0,0,0,0.12);
  cursor: pointer;
}

.scroll-btn:hover {
  background: #007bff;
  color: white;
}

.scroll-left { left: 0; }
.scroll-right { right: 0; }

/* ==== PRODUCTS ==== */
.product-scroll-wrapper {
  overflow-x: auto;
  scroll-behavior: smooth;
  white-space: nowrap;
  padding-bottom: 20px;
}

/* ==== PRODUCT CARD ==== */
.product-card {
  display: inline-block;
  width: 250px;
  margin-right: 22px;
  border-radius: 18px;

  background: rgba(255,255,255,0.85);
  padding: 15px;
  text-align: center;
  backdrop-filter: blur(6px);

  box-shadow: 0 10px 25px rgba(0,0,0,0.10);
}

.product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 15px 30px rgba(0,0,0,0.18);
}

.product-card img {
  width: 100%;
  height: 190px;
  object-fit: cover;
  border-radius: 14px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.15);
}

/* TEXT */
.product-name {
  font-size: 17px;
  font-weight: 600;
  margin-top: 10px;
}

.product-desc {
  font-size: 14px;
  color: #777;
  margin: 8px 0;
}

.product-price {
  font-size: 18px;
  font-weight: bold;
  margin: 12px 0;
  color: #007bff;
}

/* ADD TO CART */
.add-to-cart {
  background: linear-gradient(45deg, #007bff, #00a2ff);
  border: none;
  padding: 10px 20px;
  color: white;
  font-weight: 600;
  cursor: pointer;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0,123,255,0.4);
}

.add-to-cart:hover {
  background: linear-gradient(45deg, #0056b3, #007bff);
  transform: scale(1.05);
}
.product-card {
  opacity: 0;
  animation: fadeUp 0.6s ease forwards;
}

@keyframes fadeUp {
  from { transform: translateY(20px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}
.carousel {
  width: 90%;
  max-width: 1200px;
  height: 450px;
  overflow: hidden;
  position: relative;
  margin: 50px auto;
  border-radius: 16px;
}

.carousel-inner img {
  width: 100%;
  height: 100%;
  display: none;
  object-fit: cover;
  border-radius: 16px;
  position: absolute;
  top: 0;
  left: 0;
}

.carousel-inner img.active {
  display: block;
  animation: fadeIn 0.6s ease-in-out;
}

@keyframes fadeIn {
  from { opacity: 0; scale: 1.03; }
  to { opacity: 1; scale: 1; }
}

/* --- FIXED BUTTON POSITION --- */
.controls .btn {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(0,0,0,0.6);
  color: white;
  border: none;
  font-size: 32px;
  width: 50px;
  height: 50px;
  line-height: 42px;
  border-radius: 50%;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background 0.3s ease, scale 0.2s;
}

.controls .btn:hover {
  background: rgba(0,0,0,0.8);
  scale: 1.1;
}

/* LEFT BUTTON (perfect centered) */
.controls .prev {
  left: 20px;
}

/* RIGHT BUTTON */
.controls .next {
  right: 20px;
}

/* Pagination dots */
.pagination {
  position: absolute;
  bottom: 20px;
  width: 100%;
  display: flex;
  justify-content: center;
  gap: 10px;
}

.dot {
  width: 12px;
  height: 12px;
  background: rgba(255,255,255,0.6);
  border-radius: 50%;
  transition: 0.3s ease;
}

.dot.active {
  background: white;
  transform: scale(1.2);
}

    
</style>

<div class="carousel" aria-label="Category banner carousel">
  <div class="carousel-inner">
    <?php foreach ($categories as $index => $cat): ?>
      <img
        src="cat_images/<?= htmlspecialchars($cat['category_image']) ?>"
        alt="<?= htmlspecialchars($cat['name']) ?>"
        class="<?= $index === 0 ? 'active' : '' ?>"
        data-index="<?= $index ?>"
      />
    <?php endforeach; ?>
  </div>
  <div class="controls">
    <button class="btn prev" aria-label="Previous slide">⟨</button>
    <button class="btn next" aria-label="Next slide">⟩</button>
  </div>
  <div class="pagination" role="tablist"></div>
</div>

<div class="hot-selling-container">
  <div class="category-title">🔥 Hot Selling Products</div>
  <div class="scroll-wrapper">
    <button class="scroll-btn scroll-left" onclick="scrollCategory('hot-selling-slider', -1)" aria-label="Scroll left">&#10094;</button>

    <div class="product-scroll-wrapper" id="hot-selling-slider">
      <?php if ($result_hot && mysqli_num_rows($result_hot) > 0): ?>
        <?php while ($product = mysqli_fetch_assoc($result_hot)): 
          $image = $product['image_path'] ? 'images_folder/' . $product['image_path'] : 'images_folder/no-image.jpg';
  $productId = $product['product_id'];
        ?>
          <a href="product_view.php?id=<?= $productId ?>" style="text-decoration: none; color: inherit;">
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
        <p style="text-align:center;">No hot-selling products found.</p>
      <?php endif; ?>
    </div>

    <button class="scroll-btn scroll-right" onclick="scrollCategory('hot-selling-slider', 1)" aria-label="Scroll right">&#10095;</button>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    const $images = $('.carousel-inner img');
    const total = $images.length;
    let currentIndex = 0;

    for (let i = 0; i < total; i++) {
      $('.pagination').append('<div class="dot" data-index="' + i + '" role="tab" tabindex="0"></div>');
    }
    $('.dot').first().addClass('active');

    function showImage(index) {
      $images.removeClass('active').fadeOut(400);
      $images.eq(index).fadeIn(400).addClass('active');
      $('.dot').removeClass('active');
      $('.dot[data-index="' + index + '"]').addClass('active');
      currentIndex = index;
    }

    $('.next').click(function() {
      let nextIndex = (currentIndex + 1) % total;
      showImage(nextIndex);
    });

    $('.prev').click(function() {
      let prevIndex = (currentIndex - 1 + total) % total;
      showImage(prevIndex);
    });

    $('.dot').click(function() {
      const index = $(this).data('index');
      showImage(index);
    });

    setInterval(function() {
      let nextIndex = (currentIndex + 1) % total;
      showImage(nextIndex);
    }, 5000);
  });

  function scrollCategory(containerId, direction) {
    const container = document.getElementById(containerId);
    const cardWidth = 270;
    container.scrollBy({
      left: direction * cardWidth,
      behavior: 'smooth'
    });
  }

  // Add to Cart functionality
  document.addEventListener('DOMContentLoaded', function() {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');

    addToCartButtons.forEach(button => {
      button.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();

        // Get product ID from the parent product card
        const productCard = this.closest('.product-card');
        const productLink = productCard.closest('a');
        const productUrl = productLink.getAttribute('href');
        const productId = new URLSearchParams(new URL(productUrl, window.location).search).get('id');

        // Check if user is logged in by making a test request
        fetch('handleCart.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: 'scope=check'
        })
        .then(response => response.text())
        .then(data => {
          if (data === '401') {
            // User not logged in, redirect to login
            window.location.href = 'user_login.php?redirect=' + encodeURIComponent(window.location.href);
          } else {
            // User is logged in, show quantity input
            const qty = prompt('Enter quantity:', '1');
            if (qty && qty > 0) {
              addProductToCart(productId, qty);
            }
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('An error occurred. Please try again.');
        });
      });
    });
  });

  function addProductToCart(productId, quantity) {
    fetch('handleCart.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: 'scope=add&prod_id=' + productId + '&prod_qty=' + quantity
    })
    .then(response => response.text())
    .then(data => {
      if (data === '201') {
        alert('Product added to cart successfully!');
        // Optionally redirect to cart
        // window.location.href = 'cart.php';
      } else if (data === '401') {
        window.location.href = 'user_login.php?redirect=' + encodeURIComponent(window.location.href);
      } else {
        alert('Error adding product to cart');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('An error occurred. Please try again.');
    });
  }
</script>

<?php include 'products_by_category.php'; ?>
<?php include 'partials/efooter.php'; ?>
