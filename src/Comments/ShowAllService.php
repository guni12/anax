<?php

namespace Guni\Comments;

use \Anax\DI\DIInterface;
use \Guni\Comments\Comm;

/**
 * Form to update an item.
 */
class ShowAllService
{
    /**
    * @var array $comments, all comments.
    */
    protected $comments;
    protected $sess;
    protected $users;
    protected $user;

    /**
     * Constructor injects with DI container and the id to update.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di)
    {
        $this->di = $di;
        $this->comments = $this->getAll();
        $session = $this->di->get("session");
        $this->sess = $session->get("user");
        $addsess = isset($this->sess) ? $this->sess : null;
        $this->sess = $addsess;
        $userController = $this->di->get("userController");
        $this->users = $userController->getAllUsers();
        $this->user = $userController->getOne($this->sess['id']);
    }

    /**
     * Get details on comments.
     *
     *
     * @return All comments
     */
    public function getAll()
    {
        $comm = new Comm();
        $comm->setDb($this->di->get("db"));
        return $comm->findAll();
    }


    /**
     * Sets the callable to use for creating routes.
     *
     * @param callable $urlCreate to create framework urls.
     *
     * @return void
     */
    public function setUrlCreator($route)
    {
        $url = $this->di->get("url");
        return call_user_func([$url, "create"], $route);
    }


    public function getGravatar($item)
    {
        $comm = new Comm();
        $gravatar = $comm->getGravatar($item);
        return '<img src="' . $gravatar . '" alt=""/>';
    }


    public function getExtra($item)
    {
        $extra = "";
        if ($item) {
            $extra .= '<br />Uppdaterades: ' . $item;
        }
        return $extra;
    }


    public function getHTML()
    {
        $loggedin = "";
        $showid = "";
        $gravatar = "";
        $extra = "";
        $html = "";

        $isadmin = $this->sess['isadmin'] == 1 ? true : false;

        $create = $this->setUrlCreator("comm/create");
        $del = $this->setUrlCreator("comm/admindelete");
        $viewone = $this->setUrlCreator("comm/view-one");

        $loggedin = '<a href="user/login">Logga in om du vill kommentera</a>';

        if ($this->sess['id']) {
            $loggedin = ' <a href="' . $create .'">Skriv ett inlägg</a>';
            if ($isadmin == true) {
                $loggedin .= ' | <a href="' . $del . '">Ta bort ett inlägg</a>';
            }
        }


        $html .= '<div class="col-sm-12 col-xs-12">
        <div class="col-lg-6 col-sm-7 col-xs-7">
        <h3>Gruppinlägg <span class="small">' . $loggedin . '</span></h3>
        <hr />';

        foreach ($this->comments as $value) {
            if ((int)$value->parentid > 0) {
                continue;
            }
            $gravatar = $this->getGravatar($value->email);
            $extra = $this->getExtra($value->updated);
            if ($isadmin == true) {
                $showid = '(' . $value->id . '): ';
            }
            $html .= '<h4><a href="' . $viewone . '/' . $value->id . '">' . $showid . ' ' . $value->title . '</a></h4><p>' . $value->created . ' ' . $value->email . ' ' . $gravatar . ' ' . $extra . '</p><hr />';
        }
        
        $html .= '</div></div>';
        return $html;
    }
}
