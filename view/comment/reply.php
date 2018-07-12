<?php
if ($this->di->get("session")->get("userLoggedIn")) {
    $user = $this->di->get("userController")->getUser($this->di->get("session")->get("userLoggedIn"), "acronym");

    if (isset($content[0]->comment)) {
        $thePostID = $content[0]->postID;

        if ($content[0]->is_post == 1) {
            $thePostID = $content[0]->id;
        }
        echo <<< EOD
        <form action="../reply_comment_action" method="POST">
            <div class="form-group">
                Replying to comment:
                <div class="card">
                    <div class="card-body">
                    {$this->di->get("textfilter")->markdown(htmlspecialchars($content[0]->comment, ENT_QUOTES))}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Email address</label>
                <input name="email" type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" value="{$user->email}" readonly required>
            </div>
            <div class="form-group">
                <label>Comment</label>
                <textarea name="comment_area" class="form-control" rows="3" required></textarea>
            </div>
            <input type="hidden" name="post_id" value="{$thePostID}">
            <input type="hidden" name="comment_id" value="{$content[0]->id}">
            <a class="btn btn-outline-primary" href="{$this->di->get("url")->create("comment")}">Go back</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
EOD;
    } else {
        $this->di->get("response")->redirect($this->di->get("url")->create("comment"));
    }
} else {
    echo sprintf('Please login to post a reply. Login <a href="%s">here<a/>', $this->di->get("url")->create("user/login"));
    echo '<br>';
    echo sprintf('To create a user, click <a href="%s">here<a/>', $this->di->get("url")->create("user/create"));
}
