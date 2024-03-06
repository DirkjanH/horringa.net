<?php /*________________________________________________________________


lixlpixel PHParadise

_______________________________________________________________________

category :		image handling

snippet :		image upload and resize

downloaded :	10.20.2006 - 02:28

file URL :		http://www.fundisom.com/phparadise/php/image_handling/image_upload_and_resize

description :	this little script resizes your uploaded image on the fly and saves it as thumbnail.

 respects aspect ratio and doesn't distort your image

___________________________START___COPYING___HERE__________________*/ ?>


<?php

if(isset($_POST['Submit']))

{
	$size = 150; // the thumbnail height

	$filedir = 'c:/Documents and Settings/Dirkjan/Bureaublad/'; // the directory for the original image
	$thumbdir = '../Digiflyers/'; // the directory for the thumbnail image
	$prefix = ''; // the prefix to be added to the original name

	$maxfile = '2000000';
	$mode = '0666';
	
	$userfile_name = $_FILES['image']['name'];
	$userfile_tmp = $_FILES['image']['tmp_name'];
	$userfile_size = $_FILES['image']['size'];
	$userfile_type = $_FILES['image']['type'];
	
	if (isset($_FILES['image']['name'])) 
	{
		$prod_img = $filedir.$userfile_name;

		$prod_img_thumb = $thumbdir.$prefix.$userfile_name;
		move_uploaded_file($userfile_tmp, $prod_img);
		chmod ($prod_img, octdec($mode));
		
		$sizes = getimagesize($prod_img);

		$aspect_ratio = $sizes[1]/$sizes[0]; 

		if ($sizes[1] <= $size)
		{
			$new_width = $sizes[0];
			$new_height = $sizes[1];
		}else{
			$new_height = $size;
			$new_width = abs($new_height/$aspect_ratio);
		}

		$destimg=ImageCreateTrueColor($new_width,$new_height)
			or die('Problem In Creating image');
		$srcimg=ImageCreateFromJPEG($prod_img)
			or die('Problem In opening Source Image');
		if(function_exists('imagecopyresampled'))
		{
			imagecopyresampled($destimg,$srcimg,0,0,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg))
			or die('Problem In resizing');
		}else{
			Imagecopyresized($destimg,$srcimg,0,0,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg))
			or die('Problem In resizing');
		}
		ImageJPEG($destimg,$prod_img_thumb,90)
			or die('Problem In saving');
		imagedestroy($destimg);
	}

	echo '
	<a href="'.$prod_img.'">
		<img src="'.$prod_img_thumb.'" width="'.$new_width.'" height="'.$new_height.'">
	</a>';

}else{

	echo '
	<form method="POST" action="'.$_SERVER['PHP_SELF'].'" enctype="multipart/form-data">
	<input type="file" name="image"><p>
	<input type="Submit" name="Submit" value="Submit">
	</form>';
}

?>