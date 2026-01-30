<?php
$isLoggedIn = isset($_SESSION['user_id']);
?>

<header style="
    background:#1a1a1a; 
    padding:18px 0;
    box-shadow:0 4px 10px rgba(0,0,0,0.3);
">
  <div style="
      max-width:1300px; 
      margin:auto; 
      display:flex; 
      justify-content:space-between; 
      align-items:center;
      padding:0 20px;
  ">

    <!-- Logo -->
    <h1 style="
        font-size:26px; 
        color:#fff; 
        margin:0; 
        font-weight:700;
        letter-spacing:1px;
    ">
      My<span style="color:#ffb84d;">Store</span>
    </h1>

    <!-- Navigation -->
    <nav style="display:flex; gap:20px; align-items:center;">

      <a href="home.php" style="
          color:#fff; 
          text-decoration:none; 
          font-size:16px;
          padding:8px 14px;
          border-radius:6px;
          transition:0.3s;
      " onmouseover="this.style.background='#333'" onmouseout="this.style.background='none'">
        Home
      </a>

      <a href="cart.php" style="
          color:#fff; 
          text-decoration:none; 
          font-size:16px;
          padding:8px 14px;
          border-radius:6px;
          transition:0.3s;
      " onmouseover="this.style.background='#333'" onmouseout="this.style.background='none'">
        Cart
      </a>

      <?php if(!$isLoggedIn): ?>

        <a href="login.php" style="
            color:#1a1a1a; 
            background:#ffb84d;
            padding:8px 16px;
            border-radius:6px;
            font-weight:600;
            text-decoration:none;
            transition:0.3s;
        " onmouseover="this.style.background='#e6a843'" onmouseout="this.style.background='#ffb84d'">
          Login
        </a>

        <a href="signup.php" style="
            color:#1a1a1a; 
            background:#fff;
            padding:8px 16px;
            border-radius:6px;
            font-weight:600;
            text-decoration:none;
            transition:0.3s;
        " onmouseover="this.style.background='#e6e6e6'" onmouseout="this.style.background='#fff'">
          Register
        </a>

      <?php else: ?>

        <form method="POST" action="logout.php" style="display:inline;">
          <button type="submit" style="
              background:#ff4d4d; 
              border:none; 
              color:white; 
              padding:8px 16px;
              border-radius:6px;
              font-size:16px;
              cursor:pointer;
              transition:0.3s;
          " onmouseover="this.style.background='#e04343'" onmouseout="this.style.background='#ff4d4d'">
            Logout
          </button>
        </form>

      <?php endif; ?>

    </nav>
  </div>
</header>
