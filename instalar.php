<?php
$config = include 'config.php';

try {
  $conexion = new PDO('mysql:host=' . $config['db']['host'].';dbname='.$config['db']['name'], $config['db']['user'], $config['db']['pass'], $config['db']['options']);
  //$conexion = new PDO('mysql:host=localhost;dbname=tutorial_crud', 'root', 'toor');
  //$sql = file_get_contents("migracion.sql");
  $sql = 'select * from alumnos;';
  
  //echo '<br>';
  //echo "La base de datos y la tabla de alumnos se han creado con éxito.";
  //echo "<br>";

  //$sth = $conexion->prepare('SELECT * FROM alumnos');

  //$rows = $sth->fetchAll();
  $query = $conexion->prepare($sql);
  //oliiii//
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  //print_r($results);
  //if($query -> rowCount() > 0) { 

    // Usaremos el ciclo para mostrar resultados
    //foreach($results as $result) {
    //echo "<tr>";
    //echo "<td>".$result->id."</td> 
    //<td>".$result->nombre."</td> 
    //<td>".$result->email."</td> 
    //<td>".$result->edad."</td>
    //</tr>"; 
     //} 
    
  //}

} catch(PDOException $error) {
  echo $error->getMessage();
}