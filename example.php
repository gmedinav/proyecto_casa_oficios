<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


		$ojbresponse->response = 'OK';

$json = get_object_vars($ojbresponse);
echo json_encode($json);
?>