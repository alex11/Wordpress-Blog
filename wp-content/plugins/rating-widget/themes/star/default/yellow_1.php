<?php
    $theme_options = new stdClass();
    $theme_options->type = "star";
    $theme_options->style = "yellow";
    $theme_options->advanced = new stdClass();
    $theme_options->advanced->font = new stdClass();
    $theme_options->advanced->font->color = "#000000";

    $theme = array(
        "name" => "star_yellow1",
        "title" => "Yellow Stars",
        "options" => $theme_options
    );
?>