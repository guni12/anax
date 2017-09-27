<?php
/**
 * Config file for the navbar.
 */
return [
    "config" => [
        "navbar-class" => "navbar",
        "div-container" => "container-fluid",
        "div-nav" => "navbar-header",
        "span-icon" => "icon-bar"
    ],
    "items" => [
        "hem" => [
            "text" => "Hem",
            "route" => "",
        ],
        "om" => [
            "text" => "Om",
            "route" => "about",
        ],
        "report" => [
            "text" => "Redovisningar",
            "route" => "report",
        ],
        "rem" => [
            "text" => "Remserver",
            "route" => "remserver",
        ],
        "blog" => [
            "text" => "Kommentarer",
            "route" => "commpage",
        ],
    ]
];
