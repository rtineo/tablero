<?php
$newFileName= '';
if (!empty($_FILES)) {
			$tempFile = $_FILES['uploadify']['tmp_name'];
			$targetPath = '../../..'. $_REQUEST['folder'] . '/';

			
			 $ext = pathinfo($_FILES['uploadify']['name'], PATHINFO_EXTENSION);  //figures out the extension
   
   			$newFileName = md5($tempFile).'.'.$ext; //generates random filename, then adds the file extension
   			$targetFile =  str_replace('//','/',$targetPath) . $newFileName;
   
			move_uploaded_file($tempFile,$targetFile);			
			
		}

?>
<script type="text/javascript">
window.parent.limpiafile('<?php echo $newFileName; ?>');
</script>