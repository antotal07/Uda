<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "tornei_righi";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("<p style='color:red;'>Errore: " . $conn->connect_error . "</p>");
}

$sql = "SELECT * FROM classifica ORDER BY posizione ASC";
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
    <title>Classifiche - Tornei Righi</title>
</head>
<body>

    <nav>
        <div class="nav-title">
            <h1>Tornei Righi</h1>
            <p>Tornei organizzati per tutti gli anni delle superiori del Righi dal 2024</p>
        </div>
        <div class="nav-links">
            <a href="homepage.html">Home</a>
            <a href="classifiche.php" class="active">Classifiche</a>
            <a href="vincitori.html">Vincitori</a>
            <a href="squadre.php">Squadre</a>
            <a href="dove trovarci.html">Dove Trovarci</a>
        </div>
        <div class="hamburger-menu">
            <div class="hamburger-icon" onclick="toggleMenu()">☰</div>
            <div class="hamburger-dropdown" id="hamburgerDropdown">
                <a href="classifica_marcatori.php">Classifica Marcatori</a>
                <a href="altri sorteggi.html">Altri Sorteggi</a>
            </div>
        </div>
    </nav>

    <h2>Classifiche</h2>

    <table>
        <thead>
            <tr>
                <th>Posizione</th>
                <th>Squadra</th>
                <th>Punti</th>
                <th>Goal Fatti</th>
                <th>Goal Subiti</th>
                <th>Differenza Reti</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['posizione'] ?></td>
                    <td><?= htmlspecialchars($row['squadra']) ?></td>
                    <td><?= $row['punti'] ?></td>
                    <td><?= $row['goal_fatti'] ?></td>
                    <td><?= $row['goal_subiti'] ?></td>
                    <td><?= $row['differenza_reti'] ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align:center; color:#888;">Nessun dato disponibile</td>
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