
<?php
echo '<?xml version="1.0" encoding="' . $encoding . '"?>' . "\n"; ?>
<rss version="2.0"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:admin="http://webns.net/mvcb/"
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns:content="http://purl.org/rss/1.0/modules/content/">
 
    <channel>
     
    <title><?php echo $result->name; ?></title>
 
    <link><?php echo $feed_url; ?></link>
    <image><?php echo $result->images; ?></image>
    <keyword><?php echo $result->keywords; ?></keyword>
    <price><?php echo $result->title; ?></price>
    <shortdecription><?php echo $result->shortcontent; ?></shortdecription>
    <description><?php echo $page_description; ?></description>
   <dc:rights>Copyright <?php echo gmdate("Y", time()); ?></dc:rights>
 
    </channel>
</rss>