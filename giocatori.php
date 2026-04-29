<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "tornei_righi";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("<p style='color:red;'>Errore: " . $conn->connect_error . "</p>");
}

// Prende l'id squadra dall'URL
$id_squadra = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_squadra === 0) {
    die("<p style='text-align:center;'>Squadra non trovata.</p>");
}

// Prende il nome della squadra
$sql_squadra = "SELECT nome_squadra FROM squadra WHERE id_squadra = $id_squadra";
$res_squadra = $conn->query($sql_squadra);
$squadra = $res_squadra->fetch_assoc();

if (!$squadra) {
    die("<p style='text-align:center;'>Squadra non trovata.</p>");
}

// Prende i giocatori della squadra
$sql = "SELECT * FROM giocatore WHERE id_squadra = $id_squadra ORDER BY FIELD(ruolo, 'Portiere', 'Difensore', 'Centrocampista', 'Attaccante')";
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
    <title><?= htmlspecialchars($squadra['nome_squadra']) ?> - Tornei Righi</title>
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

    <h2>Rosa - <?= htmlspecialchars($squadra['nome_squadra']) ?></h2>

    <div style="text-align:center; margin-bottom: 20px;">
        <a href="squadre.php" style="color:#020263; font-size:16px;">← Torna alle Squadre</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Ruolo</th>
                <th>Goal Fatti</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id_giocatore'] ?></td>
                    <td><?= htmlspecialchars($row['nome']) ?></td>
                    <td><?= htmlspecialchars($row['cognome']) ?></td>
                    <td><?= htmlspecialchars($row['ruolo']) ?></td>
                    <td><?= $row['goal_fatti'] ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align:center; color:#888;">
                        Nessun giocatore registrato per questa squadra
                    </td>
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