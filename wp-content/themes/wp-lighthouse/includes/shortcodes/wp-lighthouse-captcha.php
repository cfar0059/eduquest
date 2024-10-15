<?php

function wp_lighthouse_generate_captcha_shortcode( $attr, $content = null) {

    extract(
		shortcode_atts(
			array(
				'length' => 6,
				'color' => 'light',
				'name'	=> false,
                'width' => 180,
                'height' => 50
			), 
			$attr
		)
	);

    $string = wp_lighthouse_captcha_gen_string($length, false);

    $captcha_name = 'captcha_string';
    if($name) { $captcha_name = 'captcha_'.$name; }

    $_SESSION[$captcha_name] = $string;

    $font = get_theme_file_path( "/includes/assets/fonts/font-".rand(1,3).".ttf" );

    $im = imagecreatetruecolor($width, $height);

    if($color == "light") {

        $white = imagecolorallocate($im, 238, 238, 238);
        $black = imagecolorallocate($im, 51, 51, 51);
    }
    else {

        $black = imagecolorallocate($im, 238, 238, 238);
        $white = imagecolorallocate($im, 51, 51, 51);
    }

    imagefilledrectangle($im, 0, 0, $width, $height, $white);
    imagettftext($im, 30, 0, 10, 40, $black, $font, $string);

    //header('Content-Type: image/png');
    ob_start();
    imagepng($im);
    imagedestroy($im);
    $imagedata = ob_get_clean();

    return "data:image/png;base64,".base64_encode($imagedata);

}

function wp_lighthouse_captcha_gen_string($length = 10, $confusing = true) {

    $characters = '23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ';
    if($confusing) { $characters .= '01il-o-ILO'; }
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {

        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}