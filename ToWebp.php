<?php

class ToWebp{

public function __construct(){}

function convert(
	$fullPath,
	$outPutQuality = 100,
	$deleteOriginal=false){

	$this->fullPath = $fullPath;
	$this->outPutQuality  = $outPutQuality;
	$this->deleteOriginal = $deleteOriginal;

	if(file_exists($this->fullPath)):

		$ext = pathinfo($fullPath, PATHINFO_EXTENSION);
		$this->extension = $ext;
		$this->newFilefullPath = str_replace('.'.$ext,'.webp',$fullPath);

		
		$isValidFormat = false;

		// Create and save
		if($this->extension == 'png' || $this->extension == 'PNG' ){
			$img = imagecreatefrompng($this->fullPath);
			$isValidFormat = true;
			
		}
		else if($this->extension == 'jpg' || $this->extension == 'JPG' || $this->extension == 'JPEG' || $this->extension == 'jpeg') {
			$img = imagecreatefromjpeg($this->fullPath);
			$isValidFormat = true;
		}
		else if($this->extension == 'gif' || $this->extension == 'GIF') {
			$img = imagecreatefromgif($this->fullPath);
			$isValidFormat = true;
		}

		if($isValidFormat){

			imagepalettetotruecolor($img);
			imagealphablending($img, true);
			imagesavealpha($img, true);
			imagewebp($img, $this->newFilefullPath,$this->outPutQuality);
			imagedestroy($img);

			//delete original file if desired
			if($this->deleteOriginal){
				unlink($this->fullPath);
			}

		}else{
			//if wrong file format
			return (Object) array('error'=>'Given file cannot be converted to webp','status'=>0);
		}
		
		$newPathInfo = explode('/', $this->newFilefullPath);
		$finalImage  = $newPathInfo[count($newPathInfo)-1];

		$result = array(
			"fullPath"=>$this->newFilefullPath,
			"file"=>$finalImage,
		    "status"=>1);

		return (Object) $result;

	else:
		return (Object) array('error'=>'File does not exist','status'=>0);
	endif;

}

}

?>