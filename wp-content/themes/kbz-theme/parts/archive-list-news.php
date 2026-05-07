<?php
    $archive_title = '';
    if (is_category()) {
        $archive_title = single_cat_title('', false) . '一覧';
    } else {
        $archive_title = 'お知らせ一覧';
    }
?>

<div class="container">
    <h2 class=""><?php echo esc_html($archive_title); ?></h2>

    archive-list-news.php

</div>