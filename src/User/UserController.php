<?php

namespace Anax\User;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
use \Anax\User\HTMLForm\UserLoginForm;
use \Anax\User\HTMLForm\CreateUserForm;
use \Anax\User\HTMLForm\UpdateUserForm;

/**
 * A controller class.
 */
class UserController implements
    ConfigureInterface,
    InjectionAwareInterface
{
    use ConfigureTrait,
        InjectionAwareTrait;



    /**
     * @var $data description
     */
    //private $data;



    /**
     * Description.
     *
     * @throws Exception
     *
     * @return void
     */
    public function getIndex()
    {
        $title      = "User profile";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $view->add("user/profile");

        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Description.
     *
     * @throws Exception
     *
     * @return void
     */
    public function getPostLogin()
    {
        $title      = "A login page";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new UserLoginForm($this->di);

        $form->check();

        $data = [
            "content" => $form->getHTML(),
        ];

        $view->add("default2/article", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Description.
     *
     * @throws Exception
     *
     * @return void
     */
    public function getPostCreateUser()
    {
        $title      = "A create user page";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new CreateUserForm($this->di);

        $form->check();

        $data = [
            "content" => $form->getHTML(),
        ];

        $view->add("default2/article", $data);

        $pageRender->renderPage(["title" => $title]);
    }

    /**
     * Handler with form to update a user.
     *
     * @param int $id User ID
     *
     * @return void
     */
    public function getPostUpdateUser($id)
    {
        $title      = "Update an item";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new UpdateUserForm($this->di, $id);

        $form->check();

        $data = [
            "form" => $form->getHTML(),
            "id" => $id,
        ];

        $view->add("user/update", $data);

        $pageRender->renderPage(["title" => $title]);
    }

    /**
     * Description.
     *
     * @param string $input What user to login.
     *
     * @throws Exception
     *
     * @return void
     */
    public function loginUser($input)
    {
        $this->di->get("session")->set("userLoggedIn", $input);
    }

    /**
     * Description.
     *
     * @throws Exception
     *
     * @return void
     */
    public function logoutUser()
    {
        $title      = "Logout page";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $view->add("user/logout");

        $pageRender->renderPage(["title" => $title]);
    }

    /**
     * Description.
     *
     * @param mixed $userInput What to search for.
     *
     * @param string $userSearch What field to check, acronym, id, email.
     *
     * @throws Exception
     *
     * @return User
     */
    public function getUser($userInput, $userSearch)
    {
        $user = new User();
        $user->setDb($this->di->get("database"));
        $user->find($userSearch, $userInput);

        return $user;
    }

    /**
     * Description.
     *
     * @throws Exception
     *
     * @return void
     */
    public function adminControl()
    {
        $title      = "Admin Control";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $sql = "SELECT * FROM `User`";

        $data = $this->di->get("database")->executeFetchAll($sql);

        $view->add("user/admin", ["content" => $data]);

        $pageRender->renderPage(["title" => $title]);
    }

    /**
     * Delete user
     *
     * @param datatype $id User ID.
     *
     * @return void
     */
    public function removeUser($id)
    {
        $sql = "DELETE FROM `User` WHERE id = ?";
        $this->di->get("database")->execute($sql, [$id]);
        $this->di->get("response")->redirect($this->di->get("url")->create("user/admin"));
    }
}
