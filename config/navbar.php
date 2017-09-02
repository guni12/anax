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
            "route" => "view/home",
        ],
        "om" => [
            "text" => "Om",
            "route" => "view/about",
        ],
        "report" => [
            "text" => "Report",
            "route" => "view/report",
        ],
        "rem" => [
            "text" => "Remserver",
            "route" => "remserver",
        ],
    ]
];
