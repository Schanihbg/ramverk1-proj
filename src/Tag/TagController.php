<?php

namespace Anax\Tag;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;

/**
 * A controller for the Tag.
 *
 * @SuppressWarnings(PHPMD.ExitExpression)
 */
class TagController implements InjectionAwareInterface
{
    use InjectionAwareTrait;


    /**
     * View all posts
     *
     * @return void
     */
    public function viewAllTags()
    {
        $data = $this->di->get("tag")->viewAllTags();

        $this->di->get("view")->add("tag/main", ["content" => $data]);
        $this->di->get("pageRender")->renderPage(["title" => "All tags"]);
    }

    /**
     * View all posts
     *
     * @return void
     */
    public function viewOneTag($tag)
    {
        $data = $this->di->get("tag")->viewOneTag($tag);

        $this->di->get("view")->add("tag/tag", ["content" => $data, "tag" => $tag]);
        $this->di->get("pageRender")->renderPage(["title" => "Tag #".$tag]);
    }
}
