<?php

function ast_create_templete_post_type()
{
    register_post_type("ast", [ // 投稿タイプ名の定義
        "labels" => [
            "name" => "定型文", // 管理画面上で表示する投稿タイプ名
            "singular_name" => "定型文", // カスタム投稿の識別名
            "all_items" => "定型文リスト",
            "add_new" => "新規追加",
            "add_new_item" => "定型文の新規追加",
            "not_found" => "定型文が見つかりませんでした。",
            "not_found_in_trash" => "定型文が見つかりませんでした。",
            "search_items" => "定型文を検索",
            "view_item" => "定型文を表示",
        ],
        "public" => true, // 投稿タイプをpublicにするか
        "exclude_from_search" => true,
        "publicly_queryable" => true,
        "hierarchical" => false,
        "has_archive" => true, // アーカイブ機能ON/OFF
        "menu_position" => 5.264, // 管理画面上での配置場所
        "menu_icon" => "dashicons-shortcode",
        "show_in_rest" => false, // REST API 使用可能
        "supports" => array("title", "editor", "author", "thunbmail", "revisions") // 投稿管理画面で使う機能
    ]);
}
add_action("init", "ast_create_templete_post_type");

function ast_flush_rewrite_rules()
{
    global $wp_rewrite;
    ast_create_templete_post_type();
    $wp_rewrite->flush_rules(false);
}
register_deactivation_hook(__FILE__, "flush_rewrite_rules");
register_activation_hook(__FILE__, "ast_flush_rewrite_rules");

// 一覧にカラム表示
function ast_add_contentsinfo_column_name($columns)
{
    $columns["shortcode"] = "ショートコード";
    return $columns;
}
add_filter("manage_ast_posts_columns", "ast_add_contentsinfo_column_name");

function ast_add_contentname_column_value($column_name, $post_id)
{
    $columns = array("shortcode");
    foreach ($columns as $column) {
        if ($column_name == $column) {
            echo '[astemp name="' . urldecode(get_post($post_id)->post_name) . '"]';
        }
    }
}
add_filter("manage_ast_posts_custom_column", "ast_add_contentname_column_value", 10, 2);
