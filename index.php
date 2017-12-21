<?php
$name = ''; $type = ''; $size = ''; $error = '';
  function resize_image($file, $w, $h, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    $src = imagecreatefromjpeg($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    return $dst;
}

        if ($_POST) {
		echo "a";
           $dir = 'upload';
		   $filename = $_FILES['file']['name'];
		   move_uploaded_file($_FILES['file']['tmp_name'],$dir.'/'.$filename);
		  
		 /* $img = imagecreatefromjpeg($dir.'/'.$filename);   
			imagejpeg($img,$dir.'/'.$filename,20); // resolusi gambar 50*/
            resize_image($dir.'/'.$filename, 400, 400);
			//$url = 'C:/Users/admin/Downloads/compressed.jpg';
           // $filename = compress_image($_FILES["file"]["tmp_name"], $url, 80);
        }else {
            $error = "Uploaded image should be jpg or gif or png";
        }
        
?>
<html>
    <head>
        <title>Php code compress the image</title>
    </head>
    <body>

        <div class="error">
           
       </div>
           <fieldset class="well">
               <legend>Upload Image:</legend>
                   <form action="index.php" name="img_compress" id="img_compress" method="post" enctype="multipart/form-data">
                       <ul>
                           <li>
                               <label>Upload:</label>
                                   <input type="file" name="file" id="file"/>
                               </li>
                           <li>
                               <input type="submit" name="submit" id="submit" class="submit btn-success"/>
                           </li>
                       </ul>
                  </form>
           </fieldset>
     </body>
</html>