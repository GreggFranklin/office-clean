<?php
//get theme options
global $data;

//standard fonts
$standard_fonts = array('default', 'Arial','Lucida Sans Unicode','Times New Roman','Verdana');

//font options
$body_font = $data['body_font'];
$headings_font = $data['headings_font'];
$callout_font = $data['callout_font'];
$navigation_font = $data['navigation_font'];
$slider_caption_font = $data['slider_caption_font'];
$tagline_font = $data['tagline_font'];

$font_options = array(
					$body_font['face'],
					$headings_font['face'],
					$callout_font['face'],
					$navigation_font['face'],
					$slider_caption_font['face'],
					$tagline_font['face']
				);
			
//loop through each font option
foreach($font_options as $font_option) {

//load stylesheet only when needed
if(!in_array($font_option, $standard_fonts)) { ?>
<link href='http://fonts.googleapis.com/css?family=<?php echo str_replace(' ', '+', $font_option); ?>' rel='stylesheet' type='text/css'>
<?php } } ?>