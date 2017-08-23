<?php
/**
 * Routes to ease development and debugging.
 */
return [
    "routes" => [
        [
            "title" => "Test",
            "message" => "Testar listor i Test.",
            //"requestMethod" => null,
            "path" => "403",
            "callable" => ["errorController", "page403"],
        ],
        [
            "info" => "500 Internal Server Error.",
            "internal" => true,
            //"requestMethod" => null,
            "path" => "500",
            "callable" => ["errorController", "page500"],
        ],
    ]
];
