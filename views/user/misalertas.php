<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Safe City</title>
    <link href="../../css/bootstrap/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="header" style="margin-top: 0px;width: 100%;position: fixed;z-index: 100;">
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="../../index.php"><b>Safe City</b></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="active"><a href="../../index.php">Inicio</a></li>
                <li><a href="../../index.php?c=acontecimiento&a=misacontecimientos">Mis acontecimientos</a></li>
                <li><a href="../../index.php?c=acontecimiento&a=view_registrar">Registar acontecimiento</a></li>
                <li><a href='javascript:obtenerubicacion()'>Ver mi zona</a></li>
                <li><a href='../../index.php?c=acontecimiento&a=all'>Muro</a></li>
                <li><a href="javascript:alerta('<?php echo $_SESSION['id_auth']; ?>')" style="color:red;" data-toggle="tooltip" data-placement="left">Botón del pánico</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['name'];?> <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="../../index.php?c=auth&a=logout">Cerrar Sesión</a></li>
                  </ul>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
    </div>
    <div class="container" style="padding-top: 60px;padding-bottom: 30px;">
        <div class="col-md-8 col-md-offset-2">
            <h3>Mis publicaciones:</h3>
                <?php
                    foreach ($_SESSION['misalertas'] as $d) {
                ?>
                    <div class="panel panel-default" >
                        <div class="panel-body">
                            <div class="col-md-12" style="text-align: right;border-bottom: solid 2px #337ab7;color: green;padding: 5px; font-size: 18px;">
                                <b><?php echo $d['tipo'];?></b>
                            </div>
                            <div class="col-md-12" style="padding: 10px;">
                                <b>Referencia: </b><?php echo $d['referencia']; ?><br>
                                <b>Descripción: </b><?php echo $d['descripcion']; ?>  
                            </div>
                            <div class="col-md-12" style="background:#ECE9E9;padding: 5px;">
                                <div class="col-md-6">
                                    <center><b><i>Fecha: </i></b><?php echo $d['fecha'];?></center>
                                </div>
                                <div class="col-md-6">
                                   <center><b><i>Hora: </i></b><?php echo $d['hora'];?></center>
                                </div>
                            </div>
                            <div class="col-md-12" style="padding: 10px;">
                                <div class="col-md-6"><center><a href='javascript:like("<?php echo $d['idacontecimiento']?>")' class="btn btn-danger btn-xs">Zona peligrosa</a></center></div>
                                <div class="col-md-6" id="<?php echo $d['idacontecimiento'];?>"><center><?php echo $d['c'];?></center></div>
                            </div>
                            <div class="input-group" class="col-md-12" style="padding: 15px;">
                                <input id="newcomentario<?php echo $d['idacontecimiento']?>"  class="form-control" type="text" placeholder="Escribe un comentario...">
                                <span class="input-group-btn">
                                    <a href="javascript:registerComentario('<?php echo $d['idacontecimiento']?>')" class="btn btn-success">ok</a>
                                </span>
                            </div>
                            <div id="miultimocomentario<?php echo $d['idacontecimiento']?>" class="col-md-12" style="background: #F6ECEC;">

                            </div> 
                            <div class="col-md-12">
                                <a href='javascript:mascomentarios("<?php echo $d['idacontecimiento']?>")' class="btn btn-default btn-xs" style="width: 100%">Más comentarios</a>
                            </div>
                            <div class="col-md-12" id="vermascomentarios<?php echo $d['idacontecimiento']?>" style="padding-top:10px;">         
                            </div>
                        </div>
                    </div>

                <?php
                      }
                ?>

        </div>
    </div>
    <script type="text/javascript" src="../../js/obtenerubicacion.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAhu8LbMrgD2NZiz6-xoaVtsy7PKLJMu3Q&sensor=false"></script>
    <script type="text/javascript" src="../../js/jquery-2.2.4.min.js"></script>
    <script type="text/javascript">
    function registerComentario(id){

                    var idacontecimiento=id;
                    var comentario = document.getElementById("newcomentario"+id).value;
                    $.ajax({
                        type: "POST",
                        url: "../../index.php?c=comentario&a=register_comentario",
                        data: {'comentario':comentario,'id':idacontecimiento}
                    }).done(function(info){
                        $("#miultimocomentario"+id).html(info);
                    });

     }
    function mascomentarios(id){
           
                $.ajax({
                    type: "POST",
                    url: "../../index.php?c=comentario&a=mascomentarios",
                    data: {'id':id}
                }).done(function(info){
                    $("#vermascomentarios"+id).html(info);
                    setInterval("loadcomentarios("+id+")",1000);
                });
    }
     function like(id){
        $.ajax({
            type: "POST",
            url: "../../index.php?c=acontecimiento&a=like",
            data: {'id':id}
        }).done(function(info){
            $("#"+id).html(info);
        });
     }
     function loadcomentarios(id){
            var idacontecimiento=id;
            $.ajax({
                type: "POST",
                url: "../../index.php?c=comentario&a=mascomentarios",
                 data: {'id':idacontecimiento}
            }).done(function(info){
                $("#vermascomentarios"+id).html(info);
            });
        }
    </script>
    <script type="text/javascript">
    $(document).on("ready", function(){
            setInterval("like1()",2000);
    });
       
      var like1= function(){
                var id=new Array();  
                <?php 
                    $nm=0;
                    foreach ($_SESSION['misalertas'] as $k): 
                ?>
                        id['<?php echo $nm?>'] = <?php echo $k['idacontecimiento']?>    ;
                        
                <?php 
                    $nm=$nm+1;
                    endforeach 
                ?>
              
                for (var i = 0; i < id.length; i++) {
                    $.ajax({
                        type: "POST",
                        url: "../../index.php?c=acontecimiento&a=like1",
                        data: {'id':id[i]}
                    }).done(function(info){
                        $("#"+id[i]).html(info);
                    });
                };   
             }
    
        
    </script>
    <script src="../../js/bootstrap.min.js"></script>
</body>
</html>



