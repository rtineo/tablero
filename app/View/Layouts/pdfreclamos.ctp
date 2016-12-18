<?php
	//$this->response->header("Content-type: application/pdf");
	header("Content-type: application/pdf");
	//$this->response->header("Content-Transfer-Encoding: UTF-8");
	header("Content-Transfer-Encoding: UTF-8");
	//$this->response->header("Content-Disposition: inline; filename=" . $nombreArchivoPdf);
	header("Content-Disposition: inline; filename=" . $nombreArchivoPdf);
	echo $content_for_layout;