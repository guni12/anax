<?php

namespace Guni\User;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
use \Guni\User\HTMLForm\UserLoginForm;
use \Guni\User\HTMLForm\UserLogout;
use \Guni\User\HTMLForm\CreateUserForm;
use \Guni\User\HTMLForm\UpdateUserForm;
use \Guni\User\HTMLForm\DeleteUserForm;
use \Guni\User\HTMLForm\AdminCreateUserForm;
use \Guni\User\HTMLForm\AdminUpdateUserForm;
use \Guni\User\HTMLForm\AdminDeleteUserForm;
use \Guni\User\ShowAllService;

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
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getIndex()
    {
        $title      = "Admin över alla användare";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        

        $session = $this->di->get("session");
        $sess = $session->get("user");

        if ($sess['isadmin'] == 1) {
            $text = new ShowAllService($this->di);
            $data = [
                "users" => $text->getHTML(),
            ];
            $view->add("user/crud/view-all", $data);
        } else {
            $data = [
                "content" => "Enbart för admin. Sorry!",
            ];
            $view->add("user/crud/default", $data);
        }
        $tempfix = "";

        $pageRender->renderPage($tempfix, ["title" => $title]);
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getPostLogin()
    {
        $title      = "Logga in";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new UserLoginForm($this->di);

        $tempfix = "";

        $form->check();

        $session = $this->di->get("session");
        $sess = $session->get("user");
        $userid = isset($sess['id']) ? $sess['id'] : null;
        $isadmin = isset($sess['isadmin']) ? $sess['isadmin'] : null;

        $url = $this->di->get("url");
        $members = call_user_func([$url, "create"], "user");
        $update = call_user_func([$url, "create"], "user/update");
        $delete = call_user_func([$url, "create"], "user/delete");
        $create = call_user_func([$url, "create"], "user/create");

        $text = '<p><span class="button"><a href="' . $create . '">Skapa ett nytt konto</a></span>';
        if ($isadmin == 1) {
            $text .= '<span class="button"><a href="' . $members . '">Till Alla Medlemmar</a></span></p>';
        } else if ((int)$userid > 0) {
            $text .= '<span class="button"><a href="' . $update . '/' . $userid . '">';
            $text .= 'Redigera ditt konto</a></span><br /><span class="button">';
            $text .= '<a href="' . $delete . '/' . $userid . '">Ta bort ditt konto</a></span></p>';
        }

        $data = [
            "content" => $form->getHTML(),
            "text" => $text,
        ];

        $view->add("user/crud/login", $data);

        $pageRender->renderPage($tempfix, ["title" => $title]);
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getPostLogout()
    {
        $title      = "Logga ut";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $text       = new UserLogout($this->di);

        $tempfix = "";

        $data = [
            "content" => $text->getHTML(),
        ];

        $view->add("user/crud/logout", $data);

        $pageRender->renderPage($tempfix, ["title" => $title]);
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
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

        $view->add("user/crud/create", $data);
        $tempfix = "";

        $pageRender->renderPage($tempfix, ["title" => $title]);
    }



    /**
     * Handler with form to update an item.
     *
     * @return void
     */
    public function getPostUpdateUser($id)
    {
        $title      = "Uppdatera användaren";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $session = $this->di->get("session");
        $sess = $session->get("user");
        $userid = isset($sess['id']) ? $sess['id'] : "";

        $url = $this->di->get("url");
        $delete = call_user_func([$url, "create"], "user/delete");

        $text = "";
        if ($id > 0) {
            $text = '<p><span class="button"><a href="';
            $text .= $delete . '/' . $userid . '">Ta bort ditt konto</a></span></p>';
        }

        if ($userid == $id) {
            $form       = new UpdateUserForm($this->di, $id);
            $form->check();

            $data = [
                "form" => $form->getHTML(),
                "text" => $text,
            ];
        } else {
            $data = [
                "form" => "Inte ditt id. Sorry!",
            ];
        }

        $view->add("user/crud/update", $data);
        $tempfix = "";

        $pageRender->renderPage($tempfix, ["title" => $title]);
    }



    /**
     * Handler with form to update an item.
     *
     * @return void
     */
    public function getPostDeleteUser($id)
    {
        $title      = "Avanmäl användare";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $session = $this->di->get("session");
        $sess = $session->get("user");
        $userid = isset($sess['id']) ? $sess['id'] : "";

        if ($userid == $id) {
            $form       = new DeleteUserForm($this->di, $id);
            $form->check();

            $data = [
                "form" => $form->getHTML(),
            ];
        } else {
            $data = [
                "form" => "Inte ditt id. Sorry!",
            ];
        }

        $view->add("user/crud/delete", $data);
        $tempfix = "";

        $pageRender->renderPage($tempfix, ["title" => $title]);
    }




    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getPostAdminCreateUser()
    {
        $title      = "A create user page";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new AdminCreateUserForm($this->di);

        $form->check();

        $data = [
            "content" => $form->getHTML(),
        ];

        $view->add("user/crud/admincreate", $data);
        $tempfix = "";

        $pageRender->renderPage($tempfix, ["title" => $title]);
    }

    /**
     * Handler with form to update an item.
     *
     * @return void
     */
    public function getPostAdminUpdateUser($id)
    {
        $title      = "Uppdatera användaren";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new AdminUpdateUserForm($this->di, $id);

        $form->check();

        $data = [
            "form" => $form->getHTML(),
        ];

        $view->add("user/crud/adminupdate", $data);
        $tempfix = "";

        $pageRender->renderPage($tempfix, ["title" => $title]);
    }



    /**
     * Handler with form to update an item.
     *
     * @return void
     */
    public function getPostAdminDeleteUser()
    {
        $title      = "Avanmäl användare";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new AdminDeleteUserForm($this->di);

        $form->check();

        $data = [
            "form" => $form->getHTML(),
        ];

        $view->add("user/crud/admindelete", $data);
        $tempfix = "";

        $pageRender->renderPage($tempfix, ["title" => $title]);
    }


    public function getAllUsers()
    {
        $user = new User();
        $user->setDb($this->di->get("db"));
        $users = $user->findAll();
        return $users;
    }


    public function getOne($id)
    {
        $user = new User();
        $user->setDb($this->di->get("db"));
        $one = $user->find("id", $id);
        //var_dump($id);

        if ($one) {
            $data = [
                "email" => $one->email,
                "id" => $one->id,
                "acronym" => $one->acronym,
                "active" => $one->active,
                "created" => $one->created,
                "isadmin" => $one->isadmin,
            ];
        } else {
            $data = [];
        }

        
        return $data;
    }
}
