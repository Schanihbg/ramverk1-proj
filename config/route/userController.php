<?php
/**
 * Routes for user controller.
 */
return [
    "routes" => [
        [
            "info" => "User Controller index.",
            "requestMethod" => "get",
            "path" => "",
            "callable" => ["userController", "getIndex"],
        ],
        [
            "info" => "User info with ID.",
            "requestMethod" => "get",
            "path" => "{id:digit}",
            "callable" => ["userController", "getOtherUser"],
        ],
        [
            "info" => "List all users.",
            "requestMethod" => "get|post",
            "path" => "users",
            "callable" => ["userController", "getAllUsers"],
        ],
        [
            "info" => "Login a user.",
            "requestMethod" => "get|post",
            "path" => "login",
            "callable" => ["userController", "getPostLogin"],
        ],
        [
            "info" => "Create a user.",
            "requestMethod" => "get|post",
            "path" => "create",
            "callable" => ["userController", "getPostCreateUser"],
        ],
        [
            "info" => "Update a user.",
            "requestMethod" => "get|post",
            "path" => "update/{id:digit}",
            "callable" => ["userController", "getPostUpdateUser"],
        ],
        [
            "info" => "Logout a user.",
            "requestMethod" => "get",
            "path" => "logout",
            "callable" => ["userController", "logoutUser"],
        ],
        [
            "info" => "Admin page.",
            "requestMethod" => "get",
            "path" => "admin",
            "callable" => ["userController", "adminControl"],
        ],
        [
            "info" => "Delete a user.",
            "requestMethod" => "get",
            "path" => "delete/{id:digit}",
            "callable" => ["userController", "removeUser"]
        ],
    ]
];
