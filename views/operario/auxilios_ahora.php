<?php
	session_start();		
?>

<strong>Registros de Acontecimientos de Delitos </strong>

<small> ¿Desea los Registros Anteriores?</small>
            
<form class="form-inline" action="../../index.php?c=auxilio&a=ver" method="POST">
  <label>Mostrar por Fecha:</label>
  <input type="date" name="fecha" class="form-control" required>                    
  <button type="submit" class="btn btn-primary">Mostrar comunicados</button>
</form>
            
<small> Lista de personas que estan presenciando un Delito</small>
            
<?php 
  if (empty($_SESSION['lista_auxilio'])) {
	    echo '<small style="color:green"><b>Mensaje:</b> No hay llamadas de delitos...</small>';
  }else{
?>
  <div class="table-responsive">
      <table class="table">
                    <tr>
	                  <th><strong>NÚMERO</strong></th>
	                  <th><strong>NOMBRE</strong></th>
	                  
	                  <th><strong>DNI</strong></th>
	                  <th><strong>UBICACION</strong></th>
	                  <th><strong>TELEFONO</strong></th>
	                  <th><strong>PERSONAL A CARGO</strong></th>
	                  <th colspan="3"><strong>QUIEN ATIENDE</strong></th>
                    </tr>
                    <?php 
                    	$num = 1;
                    	foreach ($_SESSION['lista_auxilio'] as $value) {
                    ?>
                    <tr>
	                    <td><center><?php echo "<strong>".$num."</strong>";?></center></td>
	                    <td><?php echo $value['nombre'];  ?></td>
	                   
	                    <td><?php echo $value['dni'];  ?></td>
	                    <td><?php echo $value['direccion'];  ?></td>
	                    <td><?php echo $value['telefono'];  ?></td>
	                    <td><?php echo $value['codigo']; ?></td>	                    
	                    <td>
	                      <center><a href="../../index.php?c=auxilio&a=asignar&id=<?php echo $value['idauxilio']; ?>" data-toggle="tooltip" data-placement="left" title="Asistencia">Responsable de atencion
	                      </a></center>
	                    </td>
                    </tr>  
                    <?php 
						$num++;
                		}                                          	
	                  }
	                  unset($num);	                
	                ?>
  </table>
</div>              

