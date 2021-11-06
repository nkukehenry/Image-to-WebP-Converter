# PHP Image-to-WebP-Converter
This class converts PNG,JPG &amp; GIF files to a light web friendly .webp format there by reducing the size tremendously
<pre>
<code>

//include Class
include 'ToWebp.php';

// Image
$fullPath = 'img/brazil.PNG';

$outPutQuality = 70;
//Instantiate the class
$webp = new ToWebp();

//takes in fullpath, outputQuality, deleteOriginal (true/false)
$result = $webp->convert($fullPath,$outPutQuality,true);

//towebp returns path to new file
print_r($result);

</code>
</pre>

<h3>On Success</h3>
<b>stdClass Object ( [fullPath] => img/brazil.webp [file] => brazil.webp [status] => 1 )</b>

<h3>Non-existent file error</h3>
 <b>( [error] => File does not exist [status] => 0 )</b>
 
 <h3>Wrong input file format error</h3>
 <b>( [error] => Given file cannot be converted to webp [status] => 0 )</b>
