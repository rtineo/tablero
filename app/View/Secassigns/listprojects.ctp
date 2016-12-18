<?php
if(!empty($secprojects))
{
	foreach($secprojects as $id => $value)
		echo("<option value=$id>".$value."</option>");
}
?>