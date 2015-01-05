<?php
set_time_limit(10000000);
echo getcwd();
if($_REQUEST['action']=='zip'){
	function create_zip($files = array(),$destination = '',$overwrite = false) {
		if(file_exists($destination) && !$overwrite) { return false; }
		$valid_files = array();
		if(is_array($files)) {
			foreach($files as $file) {
				if(file_exists($file)) {
					$valid_files[] = $file;
				}
			}
		}		
		if(count($valid_files)) {
			$zip = new ZipArchive();
			if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
				return false;
			}
			foreach($valid_files as $file) {
				$zip->addFile($file,$file);
			}
			$zip->close();
			return file_exists($destination);
		}
		else
		{
			return false;
		}
	}
	function getFiles($directory,$exempt = array('.','..','.ds_store','.svn'),&$files = array()) {
			$handle = opendir($directory);
			while(false !== ($resource = readdir($handle))) {
				if(!in_array(strtolower($resource),$exempt)) {
					if(is_dir($directory.$resource.'/')){
						if($directory.$resource!='/home/amalgamotion/webapps/giltjewelry/pma'){
						array_merge($files,
							getFiles($directory.$resource.'/',$exempt,$files));
							}
					}else{
					if($resource != 'phpMyAdmin-4.0.10-english.zip' && $resource != 'sites-all.tar.gz')
					
					{
					$files[] = $directory.$resource;
					}
					
						
						}
				}
			}
			closedir($handle);
			return $files;
	}
	
	$files_to_zip=getFiles('/home/amalgamotion/webapps/giltjewelry/');
	echo "<pre>";
	print_r($files_to_zip);
	echo "</pre>";
	
	$result = create_zip($files_to_zip,'betagilt.zip');
}
?>