<?php
// Para prevenir bug de cache en FF (https://bugzilla.mozilla.org/show_bug.cgi?id=327790)
// HTTP/1.1 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
// HTTP/1.0 
header("Pragma: no-cache"); 
// always modified 
header("Last-Modified: " . gmdate( "D, j M Y H:i:s", time() ) . " GMT" );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Derco: <?php echo $title_for_layout;?></title>
	    <style type="text/css">
	        <?php include(ROOT.'/app/webroot/css/derco/defecto/impresion_blanco.css');?>
	    </style>
	</head>
	<body class="bodyImpresion">
		<div id="container">
			<div id="header"></div>
			<div id="content">
                <table border="0" celpadding="0" cellspacing="0" align="center" width="100%">
                    <tr>
                        <td>
                            <center><?php echo $content_for_layout;?></center>
                        </td>
                    </tr>	
                </table>
			</div>
			<div id="footer"></div>		
		</div>
		<?php //echo $cakeDebug?>
	</body>
</html>