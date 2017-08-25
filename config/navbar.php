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
            "route" => "home",
        ],
        "om" => [
            "text" => "Om",
            "route" => "about",
        ],
        "report" => [
            "text" => "Report",
            "route" => "report",
        ],
    ]
];
