<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once 'lidhja.php';

// Fetch some stats
$emp_count = $lidhja->query("SELECT COUNT(*) as count FROM employees")->fetch_assoc()['count'];
$dept_count = $lidhja->query("SELECT COUNT(*) as count FROM departments")->fetch_assoc()['count'];
$country_count = $lidhja->query("SELECT COUNT(*) as count FROM countries")->fetch_assoc()['count'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - HR System</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="dashboard-body">
    <div class="dashboard-layout">
        <aside class="sidebar">
            <div class="logo" style="font-size: 1.5rem; font-weight: 800; margin-bottom: 2rem;">HR Admin</div>
            <nav>
                <ul style="list-style: none; display: flex; flex-direction: column; gap: 1rem;">
                    <li><a href="#" style="color: white; text-decoration: none; font-weight: 500;">Dashboard</a></li>
                    <li><a href="#" onclick="loadData('employees')"
                            style="color: #94a3b8; text-decoration: none;">Punonjesit</a></li>
                    <li><a href="#" onclick="loadData('departments')"
                            style="color: #94a3b8; text-decoration: none;">Departamentet</a></li>
                    <li><a href="#" onclick="loadData('countries')"
                            style="color: #94a3b8; text-decoration: none;">Shtetet</a></li>
                    <li style="margin-top: 2rem;"><a href="logout.php"
                            style="color: #ef4444; text-decoration: none; font-weight: 600;">Dil</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h1>Mireserdhe,
                    <?php echo htmlspecialchars($_SESSION['username']); ?>
                </h1>
                <div class="user-info" style="color: var(--text-muted);">Status: Administrator</div>
            </header>

            <div class="stats-grid"
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem;">
                <div class="card">
                    <h3 style="color: var(--text-muted); font-size: 0.875rem; text-transform: uppercase;">Punonjes</h3>
                    <p style="font-size: 2rem; font-weight: 700;">
                        <?php echo $emp_count; ?>
                    </p>
                </div>
                <div class="card">
                    <h3 style="color: var(--text-muted); font-size: 0.875rem; text-transform: uppercase;">Departamente
                    </h3>
                    <p style="font-size: 2rem; font-weight: 700;">
                        <?php echo $dept_count; ?>
                    </p>
                </div>
                <div class="card">
                    <h3 style="color: var(--text-muted); font-size: 0.875rem; text-transform: uppercase;">Shtete</h3>
                    <p style="font-size: 2rem; font-weight: 700;">
                        <?php echo $country_count; ?>
                    </p>
                </div>
            </div>

            <div class="card" id="data-view">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <h2 id="view-title">Listen e Punonjesve</h2>
                    <input type="text" id="search" placeholder="Kerko..."
                        style="padding: 0.5rem; border-radius: 6px; border: 1px solid #ddd;">
                </div>
                <div id="table-container">
                    <p>Zgjidhni nje kategori nga menuja per te pare te dhenat.</p>
                </div>
            </div>
        </main>
    </div>

    <script src="script.js"></script>
</body>

</html>