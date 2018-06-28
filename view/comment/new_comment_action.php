<?php
    $user = $this->di->get("userController")->getUser($this->di->get("session")->get("userLoggedIn"), "acronym");

    $sql = "INSERT INTO ramverk1_proj_comment (userID, comment, is_post) VALUES (?, ?, ?)";

    $this->di->get("database")->execute($sql, [$user->id, $_POST["comment_area"], 1]);

    $this->di->get("response")->redirect($this->di->get("url")->create("comment"));
