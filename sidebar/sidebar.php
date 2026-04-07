<!-- Sidebar CSS -->
<style>
  /* ===== Global ===== */
  body {
    margin: 0;
    font-family: "Segoe UI", sans-serif;
    transition: all 0.3s ease;
    overflow-x: hidden;
    background: #f4f6f9;
  }

  /* ===== Sidebar ===== */
  #sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    width: 250px;
    background: #ffffff;
    color: #222;
    transition: all 0.4s ease;
    overflow: hidden;
    box-shadow: 4px 0 20px rgba(0, 0, 0, 0.08);
    border-right: 1px solid #e5e5e5;
  }

  /* Collapsed */
  #sidebar.collapsed {
    width: 70px;
  }

  /* ===== Brand ===== */
  #sidebar .brand {
    text-align: center;
    padding: 1.2rem 0;
    font-size: 1.4rem;
    font-weight: 600;
    white-space: nowrap;
    color: #4f46e5;
    letter-spacing: 1px;
    transition: 0.3s ease;
  }

  #sidebar .brand span.short {
    display: none;
  }

  #sidebar.collapsed .brand span.full {
    display: none;
  }

  #sidebar.collapsed .brand span.short {
    display: inline;
  }

  /* ===== Navigation Links ===== */
  #sidebar .nav-link {
    color: #333;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 12px 18px;
    margin: 4px 10px;
    border-radius: 10px;
    transition: all 0.3s ease;
    white-space: nowrap;
  }

  /* Icons */
  #sidebar .nav-link i {
    min-width: 25px;
    font-size: 1.2rem;
    text-align: center;
    transition: 0.3s ease;
  }

  /* Hover */
  #sidebar .nav-link:hover {
    background: #eef2ff;
    color: #4f46e5;
    transform: translateX(6px);
  }

  /* Icon hover animation */
  #sidebar .nav-link:hover i {
    transform: scale(1.2);
  }

  /* Active */
  #sidebar .nav-link.active {
    background: #4f46e5;
    color: #fff;
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
  }

  /* Hide text when collapsed */
  #sidebar.collapsed .link-text {
    display: none;
  }

  /* ===== Content ===== */
  #content {
    margin-left: 250px;
    padding: 30px;
    transition: margin-left 0.4s ease;
  }

  #sidebar.collapsed~#content {
    margin-left: 70px;
  }

  /* ===== Toggle Button ===== */
  #sidebarCollapse {
    position: fixed;
    top: 15px;
    left: 260px;
    z-index: 1000;
    transition: left 0.4s ease, transform 0.3s ease;
    border-radius: 8px;
    padding: 6px 10px;
  }

  #toggleIcon {
    transition: transform 0.4s ease;
  }

  #sidebar.collapsed #toggleIcon {
    transform: rotate(180deg);
  }

  #sidebarCollapse:hover {
    transform: scale(1.1);
  }

  #sidebar.collapsed+#sidebarCollapse {
    left: 80px;
  }

  /* ===== Mobile ===== */
  @media (max-width: 768px) {
    #sidebar {
      left: -250px;
    }

    #sidebar.collapsed {
      left: 0;
    }

    #content {
      margin-left: 0;
    }

    #sidebarCollapse {
      left: 15px;
    }
  }
</style>
<!-- Sidebar HTML -->
<div id="sidebar">
  <div class="brand">
    <span class="full">SchoolMS</span>
    <span class="short">SMS</span>
  </div>

  <ul class="nav flex-column">

    <li class="nav-item">
      <a class="nav-link active" href="#">
        <i class="bi bi-speedometer2"></i>
        <span class="link-text">Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="index.php?page=students">
        <i class="bi bi-person-fill"></i>
        <span class="link-text">Students</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="index.php?page=teacher">
        <i class="bi bi-person-badge-fill"></i>
        <span class="link-text">Teachers</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="bi bi-building"></i>
        <span class="link-text">Classes</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="bi bi-book-fill"></i>
        <span class="link-text">Subjects</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="bi bi-calendar-check-fill"></i>
        <span class="link-text">Attendance</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/Ajax/Validation/login.php">
        <i class="bi bi-award-fill"></i>
        <span class="link-text">Logout</span>
      </a>
    </li>
  </ul>
</div>

<!-- Toggle Button -->
<button class="btn btn-primary" id="sidebarCollapse">
  <i class="bi-arrow-left-circle" id="toggleIcon"></i>
</button>

<!-- Sidebar JS -->
<script>
  let sidebar = document.getElementById("sidebar");
  let toggleBtn = document.getElementById("sidebarCollapse");
  let toggleIcon = document.getElementById("toggleIcon");

  toggleBtn.addEventListener("click", () => {
    sidebar.classList.toggle("collapsed");

    // Toggle icon between hamburger and close
    if (sidebar.classList.contains("collapsed")) {
      toggleIcon.classList.remove("bi-arrow-left-circle");
      toggleIcon.classList.add("bi-arrow-right-circle");
    } else {
      toggleIcon.classList.remove("bi-arrow-right-circle");
      toggleIcon.classList.add("bi-arrow-left-circle");
    }
  });
</script>