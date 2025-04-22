<?php
session_start();
include 'db_con.php';

// Seguridad mínima
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$result = $conn->query("SELECT * FROM logs");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="style.css">
    <style>
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #0066cc;
            color: white;
            cursor: pointer;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .container {
            width: 90%;
            max-width: 800px;
            margin: auto;
        }
    </style>
    <script>
        // Ordenar tabla al hacer clic en encabezado
        function sortTable(n) {
            var table = document.getElementById("userTable");
            var rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            switching = true;
            dir = "asc";
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    if ((dir == "asc" && x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) ||
                        (dir == "desc" && x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase())) {
                        shouldSwitch = true;
                        break;
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount++;
                } else {
                    if (switchcount === 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
    </script>
</head>
<body>

<div class="container">
    <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h2>
    
    <table id="userTable">
        <thead>
            <tr>
                <th onclick="sortTable(0)">ID</th>
                <th onclick="sortTable(1)">Usuario</th>
                <th onclick="sortTable(2)">Contraseña</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['idlog'] ?></td>
                    <td><?= htmlspecialchars($row['user']) ?></td>
                    <td><?= htmlspecialchars($row['user_pass']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
