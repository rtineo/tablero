<?php
if(!empty($secroles))
{
	foreach($secroles as $id => $value)
		echo("<option value=$id>".$value."</option>");
}
?>