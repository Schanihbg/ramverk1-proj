<?php
/**
 * Routes for the comment function.
 */

return [
    "routes" => [
        [
            "info" => "View all tags.",
            "requestMethod" => "get",
            "path" => "",
            "callable" => ["tagController", "viewAllTags"]
        ],
        [
            "info" => "View tag.",
            "requestMethod" => "get",
            "path" => "{tag:alphanum}",
            "callable" => ["tagController", "viewOneTag"]
        ],
    ]
];
