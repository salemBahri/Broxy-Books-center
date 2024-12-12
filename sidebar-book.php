<!-- book sidebar -->

<div id="sidebar-book">
    <div class="sidebar-title text-center">
        <p>Lateast Books</p>
    </div>
    <!-- display last 5 Books -->
    <?php $args = array(
        'post_type' => 'book',
        'post-status' => 'publish',
        'numberposts' => 5
    ); ?>
    <?php $recent_books = wp_get_recent_posts($args); ?>

    <?php foreach ($recent_books as $recent_book): ?>
        <div class="book text-center">
            <div class="book-thumbnail">
                <a href="<?php echo get_permalink($recent_book['ID']); ?>">
                    <?php echo get_the_post_thumbnail($recent_book['ID']); ?>
                </a>
            </div>
            <div class="book-title">
                <a href="<?php echo get_permalink($recent_book['ID']); ?>">
                    <p><?php echo $recent_book['post_title']; ?></p>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
    <?php wp_reset_query(); ?>
</div>