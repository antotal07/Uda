<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "tornei_righi";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("<p style='color:red;'>Errore: " . $conn->connect_error . "</p>");
}

$sql = "SELECT * FROM squadra ORDER BY nome_squadra ASC";
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
    <title>Squadre - Tornei Righi</title>
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
            <a href="squadre.php" class="active">Squadre</a>
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

    <h2>Squadre</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nome Squadra</th>
                <th>Numero Giocatori</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id_squadra'] ?></td>
                    <td>
                        <a href="giocatori.php?id=<?= $row['id_squadra'] ?>" class="btn-squadra">
                            <?= htmlspecialchars($row['nome_squadra']) ?>
                        </a>
                    </td>
                    <td><?= $row['numero_giocatori'] ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" style="text-align:center; color:#888;">Nessuna squadra disponibile</td>
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