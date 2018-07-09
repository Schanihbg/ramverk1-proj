<?php
    $user = $this->di->get("userController")->getUser($this->di->get("session")->get("userLoggedIn"), "acronym");

    $sql = "INSERT INTO ramverk1_proj_comment (userID, comment, is_post, post_title, tags) VALUES (?, ?, ?, ?, ?)";

    $this->di->get("database")->execute($sql, [$user->id, $_POST["comment_area"], 1, $_POST["title"], strtolower($_POST["tags"])]);

    $this->di->get("response")->redirect($this->di->get("url")->create("comment"));
