<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $title_for_layout; ?></title>
</head>
<frameset rows="103,*,50" frameborder="0" noresize="true">
	<frame id="cabecera" name="cabecera" src="<?php echo $this->webroot.'frames/cabecera'; ?>"/>
    <frameset cols="200,*" frameborder="0" noresize="true">
        <frame id="menu" name="menu" src="<?php echo $this->webroot.'frames/menu'; ?>"/>
       
        <frame id="contenido" name="contenido" src=""/>
    </frameset>
    <frame id="pie" name="pie" src="<?php echo $this->webroot.'frames/pie'; ?>"/>
</frameset>
</html>