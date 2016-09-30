	<?php 
function Conectarse()
{ 
    if (!($link=mysqli_connect('localhost', 'root', '123456', 'BD_pixelado')))
   { 

      echo "Error conectando a la base de datos."; 

      exit(); 

   } 
   return $link; 

} 

?>
