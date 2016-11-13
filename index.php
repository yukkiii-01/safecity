<?php
  
//***********************Cargar automaticamente las clases************************
    spl_autoload_register(
        function ($class){
            if(file_exists("controllers/$class.php")){
                require "/controllers/$class.php";
            }
        }    
    );

//************************Iniciar sesion*******************************************
    if(!session_id()) {
        session_start();
    }
        
//************************Frontcontroller******************************************
    if(!isset($_REQUEST['c']) && !isset($_REQUEST['a']) ){
        if(isset($_SESSION['facebook_access_token']) || isset($_SESSION['user_access_token'])) {
            $accion = 'user_ya_logueado'; 
            $controller = new AuthController($accion);
        }else{
            session_destroy();
            $accion = 'view_home';
            $controller = new HomeController($accion);
        }           
    }else{
        $controller = strtolower($_REQUEST['c']);
        $accion     = strtolower($_REQUEST['a']);

        if(isset($_SESSION['facebook_access_token']) || isset($_SESSION['user_access_token'])) {
            $controller = ucwords($_REQUEST['c']).'Controller';
            if(is_file("controllers/".$controller.".php") && method_exists($controller, $accion) ){
                $controller = new $controller($accion); 
            }else{
                header('Location: views/user/plantilla.php?v=home');
            }
        }else{
            if( $controller === "home"  &&  method_exists("HomeController", $accion) ){
                session_destroy();
                $controller = new HomeController($accion);
            }else{
                if( $controller === "auth" &&  method_exists("AuthController", $accion) ){
                    $controller = new AuthController($accion);
                }else{
                    header('Location: views/visitor/home.php');  
                }   
            }
        }        
    }

    /* */