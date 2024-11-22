<?php
include('../config.php');

$query = isset($_GET['query']) ? $_GET['query'] : '';
$query = mysqli_real_escape_string($con, $query);

$nivel = isset($_GET['nivel']) ? $_GET['nivel'] : '';
$nivel = mysqli_real_escape_string($con, $nivel);

if (!in_array($nivel, ['ADM', 'USER'])) {
    echo "<div>Invalid level</div>";
    exit;
}

$sql = "SELECT nome FROM usuario WHERE nivel = '$nivel' AND nome LIKE '%$query%' LIMIT 10";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div onclick=\"selectSuggestion('$nivel', '" . htmlspecialchars($row['nome'], ENT_QUOTES) . "', '$nivel')\">" . htmlspecialchars($row['nome']) . "</div>";
    }
} else {
    echo "<div>No suggestions found</div>";
}
?>
