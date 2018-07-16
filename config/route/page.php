<?php
/**
 * Routes for the site function.
 */

return [
    "routes" => [
        [
            "info" => "Frontpage.",
            "requestMethod" => "get",
            "path" => "",
            "callable" => ["pageController", "viewMainPage"]
        ],
    ]
];
