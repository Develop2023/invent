<?php
 include_once("includes/conf.php");
        $idestado = $_GET['estado'];


       $consulta = "SELECT * FROM tipodoc";
      $result = mysqli_query($conn,$consulta);

       $result = mysql_query("SELECT * FROM tb_cidades WHERE estado = ".$idestado);

       while($row = mysql_fetch_array($result) ){
            echo "<option value='".$row['id']."'>".$row['descricao']."</option>";

       }

    ?>