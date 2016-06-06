<?php

header('Content-Type: text/xml; charset=' . get_option('blog_charset'), true);

$link_cat = '';
if ( !empty($_GET['link_cat']) ) {
	$link_cat = $_GET['link_cat'];
	if ( !in_array($link_cat, array('all', '0')) )
		$link_cat = absint( (string)urldecode($link_cat) );
}

echo '<?xml version="1.0"?'.">\n";
?>
<?php
$xmlBody = '<opml version="1.0">';
$xmlBody .= '<head>';
$xmlBody .= '<title>'.get_the_title().'</title>';
$xmlBody .= '<dateCreated>'.gmdate("D, d M Y H:i:s").'</dateCreated>';
$xmlBody .= '</head>';
$xmlBody .= '<body>';


if ( empty($link_cat) )
	$cats = get_categories(array('taxonomy' => 'link_category', 'hierarchical' => 0));
else
	$cats = get_categories(array('taxonomy' => 'link_category', 'hierarchical' => 0, 'include' => $link_cat));

foreach ( (array)$cats as $cat ) : //main foreach
	$catname = apply_filters( 'link_category', $cat->name );
	$xmlBody .= '<category type="category" title="'.$catname.'">';

	$bookmarks = get_bookmarks(array("category" => $cat->term_id, "orderby"  => 'rating'));
	foreach ( (array)$bookmarks as $bookmark ) : //looping the $bookmarks
		$title = apply_filters( 'link_title', $bookmark->link_name );
		$xmlBody .= '<item text="'.esc_attr($title).'" type="link" htmlUrl="'.esc_attr($bookmark->link_url).'" linkDesc="'.esc_attr($bookmark->link_description).'"/>';
	endforeach;//END $bookmarks
	$xmlBody .= '</category>';
endforeach;//END main foreach
?>

<?php
$xmlBody .= '</body>';
$xmlBody .= '</opml>';

echo $xmlBody;

?>

<?php
//Outputs the .xml file
$xmlfile = new SimpleXMLElement($xmlBody);
$xmlfile->asXML('mega_menu_data.xml');
?>