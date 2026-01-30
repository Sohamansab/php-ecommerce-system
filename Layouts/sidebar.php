<!-- Sidebar Start -->
<aside class="left-sidebar" style="color: black; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh;">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between p-3 border-bottom border-light">
      <a href="/CRUD/welcome.php" class="text-nowrap logo-img">
        <img src="assets/images/logos/logo.svg" alt="Logo" style="height: 40px;" />
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-6" style="color: white;"></i>
      </div>
    </div>

    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav" style="color: white; list-style: none; padding: 0; margin: 0;">

        <!-- Main Navigation Section -->
        <li class="nav-small-cap p-3 mt-2">
          <span class="hide-menu" style="color: rgba(255,255,255,0.7); font-weight: 600; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">Main Menu</span>
        </li>

        <!-- Dashboard -->
        <li class="sidebar-item">
          <a class="sidebar-link d-flex align-items-center gap-3 p-3" href="/CRUD/welcome.php" style="color: white; text-decoration: none; border-left: 4px solid transparent; transition: all 0.3s ease;">
            <i class="ti ti-home fs-5"></i>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>

        <!-- Manage User -->
        <li class="sidebar-item">
          <a class="sidebar-link d-flex align-items-center gap-3 p-3" href="/CRUD/manage_user.php" style="color: white; text-decoration: none; border-left: 4px solid transparent; transition: all 0.3s ease;">
            <i class="ti ti-users fs-5"></i>
            <span class="hide-menu">Manage User</span>
          </a>
        </li>

        <!-- Manage Products -->
        <li class="sidebar-item">
          <a class="sidebar-link d-flex align-items-center gap-3 p-3" href="/CRUD/manage_products.php" style="color: white; text-decoration: none; border-left: 4px solid transparent; transition: all 0.3s ease;">
            <i class="ti ti-shopping-cart fs-5"></i>
            <span class="hide-menu">Manage Products</span>
          </a>
        </li>

        <!-- Reports Analytics Dropdown -->
        <li class="sidebar-item">
          <a class="sidebar-link d-flex align-items-center justify-content-between gap-3 p-3"
             href="javascript:void(0)"
             onclick="toggleReportsDropdown(event)"
             style="color: white; text-decoration: none; border-left: 4px solid transparent; transition: all 0.3s ease; cursor: pointer;">
            <div class="d-flex align-items-center gap-3">
              <i class="ti ti-chart-bar fs-5"></i>
              <span class="hide-menu">Reports Analytics</span>
            </div>
            <i class="ti ti-chevron-down fs-6" id="reportsChevron" style="transition: transform 0.3s ease;"></i>
          </a>

          <!-- Dropdown Menu -->
          <ul id="reportsDropdown" class="list-unstyled ps-4 mt-2" style="display: none; background: rgba(0,0,0,0.1); border-radius: 8px; margin: 0 10px; overflow: visible; max-height: none;">
            <li class="sidebar-item">
              <a class="dropdown-item d-flex align-items-center gap-2 p-3" href="/CRUD/monthly_rev.php" style="color: rgba(255,255,255,0.9); text-decoration: none; border-left: 3px solid transparent; transition: all 0.3s ease;">
                <i class="ti ti-calendar-month fs-6"></i>
                <span>Monthly Revenue</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="dropdown-item d-flex align-items-center gap-2 p-3" href="/CRUD/yearly_rev.php" style="color: rgba(255,255,255,0.9); text-decoration: none; border-left: 3px solid transparent; transition: all 0.3s ease;">
                <i class="ti ti-calendar-year fs-6"></i>
                <span>Yearly Revenue</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="dropdown-item d-flex align-items-center gap-2 p-3" href="/CRUD/cat_rev.php" style="color: rgba(255,255,255,0.9); text-decoration: none; border-left: 3px solid transparent; transition: all 0.3s ease;">
                <i class="ti ti-tag fs-6"></i>
                <span>Revenue by Category</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="dropdown-item d-flex align-items-center gap-2 p-3" href="/CRUD/rev_cat_year.php" style="color: rgba(255,255,255,0.9); text-decoration: none; border-left: 3px solid transparent; transition: all 0.3s ease;">
                <i class="ti ti-chart-line fs-6"></i>
                <span>Revenue: Category & Year</span>
              </a>
            </li>
          </ul>
        </li>

      </ul>
    </nav>
  </div>
</aside>
<!-- Sidebar End -->

<!-- Sidebar Dropdown Toggle Script -->
<script>
function toggleReportsDropdown(event) {
  event.preventDefault();
  const dropdown = document.getElementById('reportsDropdown');
  const chevron = document.getElementById('reportsChevron');

  if (dropdown.classList.contains('show')) {
    dropdown.classList.remove('show');
    dropdown.style.display = 'none';
    chevron.style.transform = 'rotate(0deg)';
  } else {
    dropdown.classList.add('show');
    dropdown.style.display = 'block';
    chevron.style.transform = 'rotate(180deg)';
  }
}

// Add hover effects to sidebar links
document.addEventListener('DOMContentLoaded', function() {
  const sidebarLinks = document.querySelectorAll('.sidebar-link, .dropdown-item');

  sidebarLinks.forEach(link => {
    link.addEventListener('mouseenter', function() {
      this.style.backgroundColor = 'rgba(255,255,255,0.1)';
      this.style.borderLeftColor = '#fff';
    });

    link.addEventListener('mouseleave', function() {
      this.style.backgroundColor = 'transparent';
      this.style.borderLeftColor = 'transparent';
    });
  });
});
</script>

<style>
.sidebar-link:hover, .dropdown-item:hover {
  background-color: rgba(255,255,255,0.1) !important;
  border-left-color: #fff !important;
}

.sidebar-link.active, .dropdown-item.active {
  background-color: rgba(255,255,255,0.2) !important;
  border-left-color: #fff !important;
  font-weight: 600;
}

.scroll-sidebar {
  overflow: visible !important;
}

#reportsDropdown {
  display: none !important;
  overflow: visible !important;
  max-height: none !important;
  position: relative !important;
  z-index: 1000 !important;
  width: 100% !important;
}

#reportsDropdown.show {
  display: block !important;
  overflow: visible !important;
}

#reportsDropdown li {
  display: list-item !important;
  visibility: visible !important;
  overflow: visible !important;
  max-height: none !important;
  width: 100% !important;
}

#reportsDropdown .dropdown-item {
  font-size: 14px;
  display: block !important;
  visibility: visible !important;
  overflow: visible !important;
  max-height: none !important;
  width: 100% !important;
}

#reportsDropdown .dropdown-item:hover {
  background-color: rgba(255,255,255,0.15) !important;
}
</style>

