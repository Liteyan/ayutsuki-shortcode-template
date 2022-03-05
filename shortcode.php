<?php

function ast_calltemp($atts)
{
    extract(shortcode_atts(array("name" => null), $atts));
    $q_args = array(
        "post_name" => urldecode($name),
        "post_type" => "ast",
        "numberposts" => 1,
        "post_status" => "publish"
    );
    $temppost_data = get_posts($q_args);
    $temppost_data = array_shift($temppost_data);
    $exed_shortcode = apply_filters("the_content", $temppost_data->post_content);
    return $exed_shortcode;
}
add_shortcode("astemp", "ast_calltemp");
