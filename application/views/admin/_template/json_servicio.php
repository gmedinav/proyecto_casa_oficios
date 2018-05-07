<?php
header('Content-Type: application/json');
if(isset($json))
{
	echo json_encode($json) ;
}else{
	echo "[]";
}


?>