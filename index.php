<?php
include 'funciones.php';

$error = false;
$config = include 'config.php';

try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

  if (isset($_POST['apellido'])) {
    $consultaSQL = "SELECT * FROM alumnos WHERE apellido LIKE '%" . $_POST['apellido'] . "%'";
  } else {
    $consultaSQL = "SELECT * FROM alumnos ORDER BY alumnos.id ASC";
  }

  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  $resultados = $sentencia->fetchAll();

} catch(PDOException $error) {
  $error= $error->getMessage();
}

$titulo = isset($_POST['apellido']) ? 'Lista de alumnos (' . $_POST['apellido'] . ')' : 'Lista de alumnos';
?>

<?php include "HTML/header.html"; ?>
<?php include "instalar.php"; ?>



<?php
if ($error) {
  ?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= $error ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <a href="crear.php"  class="btn btn-primary mt-4">Crear alumno</a>
      <hr>
      <form method="post" class="form-inline">
        <div class="form-group mr-3">
        </div>
      </form>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-3"><?= $titulo ?></h2>
      <table id="alumnitos"class="table">
        <thead>
          <tr>
            <th>id</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Edad</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($results && $sentencia->rowCount() > 0) {
            foreach ($results as $fila) {
              ?>
              <tr>
                <td><?php echo escapar($fila->id); ?></td>
                <td><?php echo escapar($fila->nombre); ?></td>
                <td><?php echo escapar($fila->apellido); ?></td>
                <td><?php echo escapar($fila->email); ?></td>
                <td><?php echo escapar($fila->edad); ?></td>
                <td>
                  <a href="<?= 'borrar.php?id=' . escapar($fila->id) ?>">🗑️Borrar</a>
                  <a href="<?= 'editar.php?id=' . escapar($fila->id) ?>" . >✏️Editar</a>
                </td>
              </tr>
              <?php
            }          
          }
          ?>
        <tbody>
      </table>
    </div>
  </div>
</div>

<?php include "HTML/footer.html"; ?>