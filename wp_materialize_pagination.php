<?php
function wp_materialize_pagination($args = array()){
    global $wp_query;

    $big = 999999999; // need an unlikely integer

    $pagination_items =  paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'type'               => 'array',
        'prev_text'          => __('<i class="material-icons">chevron_right</i>'),
        'next_text'          => __('<i class="material-icons">chevron_left</i>'),
        'before_page_number' => '',
        'after_page_number'  => ''

    ) );
    echo '<ul class="pagination center-align">';
    if($pagination_items != null) {
        foreach ($pagination_items as $item) {
            if (strpos($item, '<span') === false) {
                echo '<li class="waves-effect">' . $item . '</li>';
            } else {
                $item = str_replace('<span', '<a href="#"', $item);
                $item = str_replace('</span>', '</a>', $item);
                echo '<li class="active">' . $item . '</li>';
            }

        }
    }
    echo '</ul>';
}