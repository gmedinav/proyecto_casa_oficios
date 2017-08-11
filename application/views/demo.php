<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo "<html>";
echo form_open_multipart('tmrh_contactos'); 
?>

<input type="text" name="telefono">
<input type="submit" name="enviar" value="agregar">
<input type="submit" name="enviar" value="eliminar"><br>
<select name="telefonos">
    <?php
        if (empty($telef_array)==false)
        {
            foreach($telef_array as $value){
              echo "<option value='$value->telefono'>".$value->telefono."</option>";        
            }
        }
    ?>
</select>


</form>
