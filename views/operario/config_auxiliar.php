<?php
  session_start();
    foreach ($_SESSION['dato_auxilio'] as $value) {
?>
<strong>ASIGNAR RESPONSABLE</strong>
  <form class="form-horizontal" action="../../index.php?c=auxilio&a=config_asignar&id=<?php echo $value['idauxilio'] ?>" method="POST">
      <label class="col-sm-3 control-label">FECHA:</label>
      <input type="text" name="fecha" readonly="readonly" class="form-control" value="<?php echo $value['fecha'];?>" required maxlength="8">
      <label class="col-sm-3 control-label">HORA:</label>
      <input type="text" name="hora" readonly="readonly" class="form-control" value="<?php echo $value['hora'];?>" required maxlength="50">
      <label class="col-sm-3 control-label">DNI AUXILIADOR:</label>
      <input type="text" name="id_pol" class="form-control" required maxlength="30">
      <center><button type="submit" class="btn btn-primary">Guardar cambios</button></center>
  </form>

<?php
} 
?>

