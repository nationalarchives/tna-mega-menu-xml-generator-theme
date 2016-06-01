<?php
/*
Template Name: XML Output Template
*/

header('Content-Type: text/xml; charset=' . get_option('blog_charset'), true);

$link_cat = '';
if ( !empty($_GET['link_cat']) ) {
    $link_cat = $_GET['link_cat'];
    if ( !in_array($link_cat, array('all', '0')) )
        $link_cat = absint( (string)urldecode($link_cat) );
}

echo '<?xml version="1.0"?'.">\n";
?>

<opml version="1.0">
    <head>
        <title><?php printf( __('Links for %s'), esc_attr(get_bloginfo('name', 'display')) ); ?></title>
        <dateCreated><?php echo gmdate("D, d M Y H:i:s"); ?> GMT</dateCreated>
        <?php
        /**
         * Fires in the OPML header.
         *
         * @since 3.0.0
         */
        do_action( 'opml_head' );
        ?>
    </head>
    <body>
    <?php
    if ( empty($link_cat) )
        $cats = get_categories(array('taxonomy' => 'link_category', 'hierarchical' => 0));
    else
        $cats = get_categories(array('taxonomy' => 'link_category', 'hierarchical' => 0, 'include' => $link_cat));

    foreach ( (array)$cats as $cat ) :
        /**
         * Filter the OPML outline link category name.
         *
         * @since 2.2.0
         *
         * @param string $catname The OPML outline category name.
         */
        $catname = apply_filters( 'link_category', $cat->name );

        ?>
        <category type="category" title="<?php echo esc_attr($catname); ?>">
            <?php
            $bookmarks = get_bookmarks(array
            ("category" => $cat->term_id,
             "orderby"  => 'rating'
             )
            );
            foreach ( (array)$bookmarks as $bookmark ) :
                /**
                 * Filter the OPML outline link title text.
                 *
                 * @since 2.2.0
                 *
                 * @param string $title The OPML outline title text.
                 */
                $title = apply_filters( 'link_title', $bookmark->link_name );
                ?>
                <item text="<?php echo esc_attr($title); ?>" type="link" xmlUrl="<?php echo esc_attr($bookmark->link_rss); ?>" htmlUrl="<?php echo esc_attr($bookmark->link_url); ?>" updated="<?php if ('0000-00-00 00:00:00' != $bookmark->link_updated) echo $bookmark->link_updated; ?>" linkDesc="<?php echo esc_attr($bookmark->link_description); ?>"/>
                <?php
            endforeach; // $bookmarks
            ?>
        </category>
        <?php
    endforeach; // $cats
    ?>
    </body>
</opml>

<?php
//Outputs the .xml file
$xmlfile = new SimpleXMLElement($homepage);
$xmlfile->asXML('file.xml');
?>