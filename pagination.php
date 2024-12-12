<div id="pagination">
    <?php
    global $wp_query;
    $big = 999999999; // Need an unlikely integer for replacement
    $pagination_links = paginate_links(array(
        'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format'    => '?paged=%#%',
        'current'   => max(1, get_query_var('paged')),
        'total'     => $wp_query->max_num_pages,
        'prev_text' => '&laquo;', // Left arrow for "Previous"
        'next_text' => '&raquo;', // Right arrow for "Next"
        'type'      => 'list',   // Outputs pagination links as a list
    ));
    echo $pagination_links;
    ?>
</div>
