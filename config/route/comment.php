<?php
/**
 * Routes for the comment function.
 */

return [
    "routes" => [
        [
            "info" => "View all posts.",
            "requestMethod" => "get",
            "path" => "",
            "callable" => ["commentController", "viewAll"]
        ],
        [
            "info" => "New post.",
            "requestMethod" => "get",
            "path" => "new",
            "callable" => ["commentController", "newPost"]
        ],
        [
            "info" => "New post action.",
            "requestMethod" => "post",
            "path" => "new_comment_action",
            "callable" => ["commentController", "newPostAction"]
        ],
        [
            "info" => "Reply post.",
            "requestMethod" => "get|post",
            "path" => "reply/{id:digit}",
            "callable" => ["commentController", "replyPost"]
        ],
        [
            "info" => "Reply post action.",
            "requestMethod" => "post",
            "path" => "reply_comment_action",
            "callable" => ["commentController", "replyPostAction"]
        ],
        [
            "info" => "Show one post.",
            "requestMethod" => "get",
            "path" => "post/{id:digit}",
            "callable" => ["commentController", "showOnePost"]
        ],
        [
            "info" => "Edit post.",
            "requestMethod" => "get",
            "path" => "edit/{id:digit}",
            "callable" => ["commentController", "editPost"]
        ],
        [
            "info" => "Edit post action.",
            "requestMethod" => "post",
            "path" => "edit/update_comment_action",
            "callable" => ["commentController", "editPostAction"]
        ],
        [
            "info" => "Delete one post.",
            "requestMethod" => "get",
            "path" => "delete/{id:digit}",
            "callable" => ["commentController", "removePost"]
        ],
    ]
];
