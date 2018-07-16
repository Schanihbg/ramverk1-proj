<?php

namespace Anax\Page;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;

/**
 * A controller for the Page.
 *
 * @SuppressWarnings(PHPMD.ExitExpression)
 */
class PageController implements InjectionAwareInterface
{
    use InjectionAwareTrait;


    /**
     * View all posts
     *
     * @return void
     */
    public function viewMainPage()
    {
        $sqlTopUser= "SELECT userID, COUNT(*) as count FROM `ramverk1_proj_comment` GROUP BY userID ORDER by count DESC";
        $sqlUsers = "SELECT * FROM `User`";

        $comments = $this->di->get("comment")->viewAll();
        $tags = $this->di->get("tag")->viewAllTags();
        $topUsers = $this->di->get("database")->executeFetchAll($sqlTopUser);
        $users = $this->di->get("database")->executeFetchAll($sqlUsers);

        $this->di->get("view")->add("page/main", [
            "comments" => $comments,
            "topUsers" => $topUsers,
            "users" => $users,
            "tags" => $tags
        ]);

        $this->di->get("pageRender")->renderPage(["title" => "Frontpage"]);
    }
}
