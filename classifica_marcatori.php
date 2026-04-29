<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "tornei_righi";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("<p style='color:red;'>Errore: " . $conn->connect_error . "</p>");
}

$sql = "SELECT * FROM classifica_marcatori ORDER BY goal_fatti DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="css.css">
    <link rel="icon" type="image/png" href="favicon.png">
    <title>Classifica Marcatori - Tornei Righi</title>
</head>
<body>

    <nav>
        <div class="nav-title">
            <h1>Tornei Righi</h1>
            <p>Tornei organizzati per tutti gli anni delle superiori del Righi dal 2024</p>
        </div>
        <div class="nav-links">
            <a href="homepage.html">Home</a>
            <a href="classifiche.php">Classifiche</a>
            <a href="vincitori.html">Vincitori</a>
            <a href="squadre.php">Squadre</a>
            <a href="dove trovarci.html">Dove Trovarci</a>
        </div>
        <div class="hamburger-menu">
            <div class="hamburger-icon" onclick="toggleMenu()">☰</div>
            <div class="hamburger-dropdown" id="hamburgerDropdown">
                <a href="classifica_marcatori.php" class="active">Classifica Marcatori</a>
                <a href="altri sorteggi.html">Altri Sorteggi</a>
            </div>
        </div>
    </nav>

    <h2>Classifica Marcatori</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Squadra</th>
                <th>Goal</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php $pos = 1; while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $pos++ ?></td>
                    <td><?= htmlspecialchars($row['nome']) ?></td>
                    <td><?= htmlspecialchars($row['cognome']) ?></td>
                    <td><?= htmlspecialchars($row['squadra']) ?></td>
                    <td><?= $row['goal_fatti'] ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align:center; color:#888;">Nessun marcatore disponibile</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php $conn->close(); ?>

    <script>
        function toggleMenu() {
            const menu = document.getElementById("hamburgerDropdown");
            menu.style.display = (menu.style.display === "block") ? "none" : "block";
        }
    </script>

</body>
</html>