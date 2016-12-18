<?php

if (!empty($_FILES)) {
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = '../../..'. $_REQUEST['folder'] . '/';
			
			//$targetFile =  str_replace('//','/',$targetPath) . utf8_decode($_FILES['Filedata']['name']);
			
			//mkdir(str_replace('//','/',$targetPath), 0755, true);
			 $ext = pathinfo($_FILES['Filedata']['name'], PATHINFO_EXTENSION);  //figures out the extension
   
   			$newFileName = md5($tempFile).'.'.$ext; //generates random filename, then adds the file extension
   			$targetFile =  str_replace('//','/',$targetPath) . $newFileName;
   
			move_uploaded_file($tempFile,$targetFile);			
			//echo utf8_decode($_FILES['Filedata']['name']);
			echo $newFileName;
		}

?>