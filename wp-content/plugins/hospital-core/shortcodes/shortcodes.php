<?php 
require plugin_dir_path(__FILE__) . '/templates/custom_map.php';
require plugin_dir_path(__FILE__) . '/templates/title.php';
require plugin_dir_path(__FILE__) . '/templates/info_box.php';
require plugin_dir_path(__FILE__) . '/templates/testimonials.php';
require plugin_dir_path(__FILE__) . '/templates/doctors_personal_info.php';
require plugin_dir_path(__FILE__) . '/templates/info_doctor.php';
require plugin_dir_path(__FILE__) . '/templates/time_table.php';
require plugin_dir_path(__FILE__) . '/templates/main_slider.php';
require plugin_dir_path(__FILE__) . '/templates/blog.php';
require plugin_dir_path(__FILE__) . '/templates/doctors_list.php';
require plugin_dir_path(__FILE__) . '/templates/department_icon.php';
require plugin_dir_path(__FILE__) . '/templates/overlap.php';
require plugin_dir_path(__FILE__) . '/templates/Doctor_team_block.php';
require plugin_dir_path(__FILE__) . '/templates/nurses.php';
require plugin_dir_path(__FILE__) . '/templates/booking_365.php';





function coinmag_get_results($selected_posts, $cat_list, $post_format, $featured_posts, $order_by, $post_sorting, $specific_posts, $post_limit, $pagination, $paged){

    $results_lists = array();
    $results_array = array();

    $post_format = explode(',', $post_format);
    if($post_format[0] == "all"){$post_format = "all";}


    $wp_args = array('post-type' => 'post', 'post-status' => 'publish', 'ignore_sticky_posts'=> 1, 'category_name' => $cat_list, 'posts_per_page' => $post_limit, 'orderby' => $order_by, 'order' => $post_sorting);



    if($selected_posts == "all"){
        if($post_format != "all" && $featured_posts == "no"):
            $wp_args += ['tax_query' => array( array('taxonomy' => 'post_format', 'field' => 'slug', 'terms' => $post_format, 'operator' => 'IN'))];
        elseif($post_format == "all" && $featured_posts == "yes"):
            $wp_args += ['meta_query'  => array( array('key' => 'coinmag_must_read', 'value' => 'yes', 'compare' => '='))];
        elseif($post_format != "all" && $featured_posts == "yes"):
            $wp_args += ['tax_query' => array( array('taxonomy' => 'post_format', 'field' => 'slug', 'terms' => $post_format, 'operator' => 'IN')), 'meta_query'  => array( array('key' => 'coinmag_must_read', 'value' => 'yes', 'compare' => '='))];
        endif;
    }else{
        $wp_args += ['post__in' => explode(',', $specific_posts)];
    }

    $the_query = new WP_Query($wp_args);
    if ($the_query->have_posts()) :
        while ($the_query->have_posts()) : $the_query->the_post();
        $results_lists[] = get_the_ID();
    endwhile;
    $max_num = $the_query->max_num_pages;
    endif; 
    wp_reset_postdata();

    $results_array += ['list' => $results_lists];
    $results_array += ['total_page' => $max_num];

    return $results_array;
}


