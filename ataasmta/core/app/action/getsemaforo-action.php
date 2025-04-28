<?php

$database = new Database();
$con = $database->connect();





// Consultas para las diferentes categorías
$sql_rojo = "SELECT * FROM alumnos WHERE (NTRI - TRI_UBICA) > 3";
if ($_POST['carrera'] != "") {
    $sql_rojo .= " AND PLA = '" . $_POST["carrera"] . "'";
}
if ($_POST['division'] != "") {
    $sql_rojo .= " AND DIV2 = '" . $_POST["division"] . "'";
}
if ($_POST['trii'] != "") {
    $sql_rojo .= " AND TRII = \"" . $_POST['trii'] . "\"";
}

$sql_verde = "SELECT * FROM alumnos WHERE  (NTRI - TRI_UBICA) <= 0";
if ($_POST['carrera'] != "") {
    $sql_verde .= " AND PLA = '" . $_POST["carrera"] . "'";
}
if ($_POST['division'] != "") {
    $sql_verde .= " AND DIV2 = '" . $_POST["division"] . "'";
}
if ($_POST['trii'] != "") {
    $sql_verde .= " AND TRII = \"" . $_POST['trii'] . "\"";
}

$sql_ambar = "SELECT * FROM alumnos WHERE ((NTRI - TRI_UBICA) BETWEEN 1 AND 3)";

if ($_POST['carrera'] != "") {
    $sql_ambar .= " AND PLA = '" . $_POST["carrera"] . "'";
}
if ($_POST['division'] != "") {
    $sql_ambar .= " AND DIV2 = '" . $_POST["division"] . "'";
}
if ($_POST['trii'] != "") {
    $sql_ambar .= " AND TRII = \"" . $_POST['trii'] . "\"";
}

// Ejecutar las consultas
$query_rojo = $con->query($sql_rojo);
$query_ambar = $con->query($sql_ambar);
$query_verde = $con->query($sql_verde);

// Inicialización de arrays
$data_rojo = array();
$data_ambar = array();
$data_verde = array();

// Llenar los arrays con los resultados de las consultas
while ($r = $query_rojo->fetch_array()) {
    $data_rojo[] = $r;
}

while ($r = $query_ambar->fetch_array()) {
    $data_ambar[] = $r;
}

while ($r = $query_verde->fetch_array()) {
    $data_verde[] = $r;
}

// Contar los elementos en cada categoría
$ambar = count($data_ambar);
$verde = count($data_verde);
$rojo = count($data_rojo);

// Establecer los arrays para sesiones (si se necesitan más adelante)
$_SESSION["ambar"] = $data_ambar;
$_SESSION['verde'] = $data_verde;
$_SESSION['rojo'] = $data_rojo;

// Calcular el máximo número de filas a mostrar en la tabla
$maximum = max($ambar, $verde, $rojo);

?>

<!-- Renderizar la gráfica usando ApexCharts -->
<div class="card">
    <div class="card-body">
        <div id="myapexchart"></div>
    </div>
</div>
<br>
<script type="text/javascript">
    var options = {
        chart: {
            height: 380,
            type: 'pie'
        },
        title: {
            text: 'SEMÁFORO POR NÚMERO DE TRIMESTRES DE REZAGO',
        },
        xaxis: {
            categories: ['Ambar', 'Verde', 'Rojo'],
        },
        series: [<?php echo $ambar; ?>, <?php echo $verde; ?>, <?php echo $rojo; ?>],
        labels: ['1 a 3', 'Regular', 'Más de 3'],
        colors: ['#f1c40f', "#27ae60", "#e74c3c"],
        grid: {
            row: {
                colors: ['#e5e5e5', 'transparent'],
            }
        }
    }

    var chart = new ApexCharts(document.querySelector("#myapexchart"), options);
    chart.render();
</script>

<!-- Tabla con los resultados clasificados -->
<div class="card">
    <div class="card-body">
        <?php if (count($data_rojo) > 0 || count($data_verde) > 0 || count($data_ambar) > 0): ?>
            <table class="table">
                <thead>
                    <th>Cantidad</th>
                    <th>Semaforo</th>
                </thead>
                <tr>
                    <td><?php echo $ambar; ?></td>
                    <td>Ambar</td>
                </tr>
                <tr>
                    <td><?php echo $verde; ?></td>
                    <td>Verde</td>
                </tr>
                <tr>
                    <td><?php echo $rojo; ?></td>
                    <td>Rojo</td>
                </tr>
            </table>
            <br>
            <table class="table">
                <thead>
                    <th>Ambar</th>
                    <th>Verde</th>
                    <th>Rojo</th>
                </thead>
                <?php for ($i = 0; $i < $maximum; $i++): ?>
                    <tr>
                        <td><?php if ($i < count($data_ambar)) { echo $data_ambar[$i]["T"]; } ?></td>
                        <td><?php if ($i < count($data_verde)) { echo $data_verde[$i]["T"]; } ?></td>
                        <td><?php if ($i < count($data_rojo)) { echo $data_rojo[$i]["T"]; } ?></td>
                    </tr>
                <?php endfor; ?>
            </table>
        <?php else: ?>
            <p class="alert alert-warning">No hay datos</p>
        <?php endif; ?>
    </div>
</div>
