<?php
$files = glob('*.php');
$exclude = ['index.php', 'header.php', 'footer.php'];

foreach ($files as $file) {
    if (in_array($file, $exclude)) continue;

    $content = file_get_contents($file);

    // Extract title
    if (preg_match('/<title>(.*)<\/title>/', $content, $matches)) {
        $title = $matches[1];
    } else {
        $title = "The ART of Using AI";
    }

    // Replace header
    $headerPattern = '/<!DOCTYPE html>.*<link href="https:\/\/fonts\.googleapis\.com\/css2\?family=Bebas\+Neue&family=DM\+Sans:ital,wght@0,300;0,400;0,500;1,300&family=Playfair\+Display:ital@0;1&display=swap" rel="stylesheet"\/>/s';
    $newHeader = "<?php \n  \$pageTitle = \"$title\";\n  include 'header.php'; \n?>";
    $content = preg_replace($headerPattern, $newHeader, $content);

    // Replace footer
    $footerPattern = '/<?php include "footer.php"; ?>
</body>
</html>";
    $content = preg_replace($footerPattern, $newFooter, $content);

    file_put_contents($file, $content);
    echo "Updated $file\n";
}
?>
