<?php

namespace Anax\Tag;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;

/**
 * Tag Model.
 */
class TagModel implements ConfigureInterface, InjectionAwareInterface
{
    use ConfigureTrait;
    use InjectionAwareTrait;


    /**
     * @var array $session inject a reference to the session.
     */
    private $session;



    /**
     * @var string $key to use when storing in session.
     */
    const KEY = "tag";



    /**
     * Inject dependency to $session..
     *
     * @param array $session object representing session.
     *
     * @return self
     */
    public function injectSession($session)
    {
        $this->session = $session;
        return $this;
    }


    /**
     * View all tags
     *
     * @return void
     */
    public function viewAllTags()
    {
        $sql = "SELECT * FROM `ramverk1_proj_comment` WHERE `tags` IS NOT NULL";

        return $this->di->get("database")->executeFetchAll($sql);
    }

    /**
     * View one tag
     *
     * @return void
     */
    public function viewOneTag($tag)
    {
        $sql = "SELECT * FROM `ramverk1_proj_comment` WHERE MATCH(tags) AGAINST (?)";

        return $this->di->get("database")->executeFetchAll($sql, ["#".$tag]);
    }
}
