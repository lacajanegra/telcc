<?php
session_start();
session_unset();
session_destroy();
header("Location: ../../login.php");
/* INSERT */

//header("Location: ../signcontratopdf.php"); /* crea pdf - alla se llamara a firmar*/

/* firmamos */

/* envia correo */


?>