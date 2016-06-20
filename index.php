<?php

header('Content-Type: text/xml; charset=' . get_option('blog_charset'), true); //This sets the content type to a xml document and renders the proper format in a browser.

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
$xmlBody .= '<dateCreated>'.gmdate( 'D, d M Y H:i:s' ) . ' GMT</dateCreated>';
$xmlBody .= '</head>';
$xmlBody .= '<body>';


if ( empty($link_cat) )
	$cats = get_categories(array('taxonomy' => 'link_category', 'hierarchical' => 0));
else
	$cats = get_categories(array('taxonomy' => 'link_category', 'hierarchical' => 0, 'include' => $link_cat));

foreach ( (array)$cats as $cat ) : //Loops the Links Categories
	$catname = apply_filters( 'link_category', $cat->name );
	$caturl = apply_filters( 'link_category', $cat->slug );
	$xmlBody .= '<category type="category" title="'.$catname.'" catUrl="'.$caturl.'">';

	$bookmarks = get_bookmarks(array("category" => $cat->term_id, "orderby"  => 'rating')); // Setting the parameters, The ID of the category and Ordering
	foreach ( (array)$bookmarks as $bookmark ) : //Loops links of each category
		$title = apply_filters( 'link_title', $bookmark->link_name );
		$xmlBody .= '<item text="'.esc_attr($title).'" type="link" htmlUrl="'.esc_attr($bookmark->link_url).'" linkDesc="'.esc_attr($bookmark->link_description).'"/>';
	endforeach;//END loop links
	$xmlBody .= '</category>';
endforeach;//END loop category links
?>

<?php
$xmlBody .= '</body>';
$xmlBody .= '</opml>';

echo $xmlBody;

?>

<?php

delete_site_transient( 'cache_xml' ); // Deletes the xml cache on the network, when the new xml if rendered.

$xmlfile = new SimpleXMLElement($xmlBody); //Creates a .xml file to the root folder
$xmlfile->asXML('mega_menu_data.xml'); // Saves it to the root folder under the file name 'mega_menu_data.xml'
?>