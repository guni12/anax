<?php
/**
 * Config-file for REM Server.
 */

return [

    // Default settings are read from files
    "dataset" => [
        ANAX_APP_PATH . "/config/remserver/users.json",
        ANAX_APP_PATH . "/config/remserver/report.json",
        ANAX_APP_PATH . "/config/remserver/comments.json"
    ]
];
