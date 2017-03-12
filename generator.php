<?php
function generateZip($id){
    $template_name = "To Peaso";
    $filepath = "temp/";
    $download_filename = "_Template_Generator.zip";
    $filename = $id."_temp.zip";

    //Opening zip if exists else file will be created
    $zip = new ZipArchive();
    if (!$zip->open($filepath.$filename)===TRUE) { //If it doesn't exist
        if ($zip->open($filepath.$filename, ZipArchive::CREATE)!==TRUE) {
            exit("cannot open <$filepath.$filename>\n");
        }
        
        $zip->addFromString($template_name."/index.php", generateIndex());
        $zip->addFromString($template_name."/header.php", generateHeader());
        $zip->addFromString($template_name."/footer.php", generateFooter());
        $zip->close();

    }

    //Client downloading
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"".str_replace(' ', '_', $template_name).$download_filename."\"");
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".filesize($filepath.$filename));
    ob_end_flush();
    clearstatcache();
    readfile($filepath.$filename);
    exit;
}
function generateIndex(){
    $web = "getHeader();
Test
getFooter();";
    return $web;
}
function generateHeader(){
    $web = "<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset=	<?php bloginfo( 'charset' ); ?>\">
	<title><?php wp_title(); ?></title>

	<!-- Definir viewport para dispositivos web móviles -->
	<meta name=\"viewport\" content=\"width=device-width, minimum-scale=1\">

	<link rel=\"shortcut icon\" href=\"<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico\" />
	<link rel=\"stylesheet\" media=\"all\" href=\"<?php bloginfo( 'stylesheet_url' ); ?>\" />

	<link rel=\"pingback\" href=\"<?php bloginfo( 'pingback_url' ); ?>\" />

	<?php wp_head(); ?>
</head>
<body>
	<div class=\"wrapper\">
		<header>
			<h1><a href=\"<?php echo get_option('home'); ?>\"><?php bloginfo('name'); ?></a></h1>
			<hr>
			<?php wp_nav_menu( array('menu' => 'Main', 'container' => 'nav' )); ?>
		</header>";
    return $web;

}
function generateFooter(){
    $web = "        <footer>
	        <p>&amp;amp;amp;copy; <?php bloginfo('name'); ?>, <?=date('Y');?>. Testing.</p>
        </footer>
    </div> <!-- Fin de wrapper -->
<?php wp_footer(); ?>
</body>
</html>
";
    return $web;
}
?>