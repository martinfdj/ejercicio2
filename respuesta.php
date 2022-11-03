<html>
    
    <head>
        <title>Markanator</title>
        <link rel="stylesheet" type="text/css" href="css/akinator.css">
    </head>
    <body>
    <header>        
        <h1>Markanator</h1>
    </header>
    <main>
        <?php
        //CONECTAMOS CON LA BD
        require "conexion.php";
        //RECOGEMOS LA RESPUESTA
        $respuesta = $_GET["r"];
        $nodo = $_GET["n"];
        $nombreAnterior = $_GET["p"];
        $numPregunta = $_GET["np"];
        
        function formularioRespuesta($n,$p){
            echo "<div class='contenedorPregunta'>";
            echo "<textarea id='nodo' name='nodo' form='formulario' placeholder='nombre' style='display:none;'>".$n."</textarea>";
            echo "<textarea id='nombreAnterior' name='nombreAnterior' form='formulario' placeholder='nombre' style='display:none;'>".$p."</textarea>";
            echo "<h2>¿En quién habías pensado?</h2>";
            echo "<textarea id='nombre' name='nombre' form='formulario' placeholder='nombre'></textarea>";
            echo "<h2>¿Qué característica tiene este personaje que no tenga ".$p."?</h2>";
            echo "<textarea id='caracteristicas' name='caracteristicas' form='formulario' placeholder='caracteristicas'></textarea>";
            echo "<form action='crear.php' id='formulario' method='POST' >";
            echo "<button type='submit' name='ENVIAR'>ENVIAR</button>";
            echo "</form>";
            echo "</div>";
            
        }
        
        //SI HA FALLADO
        if($respuesta == 0){
            session_start();			//iniciamos la sesión
            $nodosRepuesto =array();	//creamos el array
           
            if(isset($_SESSION['nodosRepuesto'])){
                $nodosRepuesto = $_SESSION['nodosRepuesto'];
                $tamano = count($nodosRepuesto);			
                
                if($tamano != 0){
                  
                    $nodoRevisar = array_pop($nodosRepuesto);	
                    $_SESSION['nodosRepuesto']=$nodosRepuesto;  
                    header("Location:index.php?n=".$nodoRevisar."&r=0&np=".$numPregunta."");	
                }

                else{
                    
                    formularioRespuesta($nodo,$nombreAnterior);
                }
            }
            
            else{
                
                formularioRespuesta($nodo,$nombreAnterior);
            }
        }

        else{
            $consulta = "INSERT INTO partida (personaje,acierto) VALUES('".$nombreAnterior."',TRUE);";
            mysqli_query($enlace, $consulta);
            session_start();		//iniciamos la sesión
            $arrayVacio =array();	
            
            if(isset($_SESSION['nodosRepuesto'])){
                $_SESSION['nodosRepuesto']=$arrayVacio;
            }
    
            echo "<h2>¡GRACIAS POR JUGAR A MARTINATOR! ;)</h2>";
        }
        ?>
    </main>
    <br>
    <br>
    <footer>
        <?php
            echo "<a href='index.php?n=1&r=0'>Volver a probar</a>";
            echo "<br><br><a href='datos.php'>Datos de Martinator</a>";
        ?>
    </footer>
    </body>
</html>