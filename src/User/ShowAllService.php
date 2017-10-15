<?php

namespace Guni\User;

use \Anax\DI\DIInterface;
use \Guni\User\User;

/**
 * Form to update an item.
 */
class ShowAllService
{
    /**
    * @var array $comments, all comments.
    */
    protected $sess;
    protected $users;

    /**
     * Constructor injects with DI container and the id to update.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di)
    {
        $this->di = $di;
        $this->users = $this->getAll();
        $session = $this->di->get("session");
        $this->sess = $session->get("user");
        $addsess = isset($this->sess) ? $this->sess : null;
        $this->sess = $addsess;
    }

    /**
     * Get details on comments.
     *
     *
     * @return All comments
     */
    public function getAll()
    {
        $user = new User();
        $user->setDb($this->di->get("db"));
        return $user->findAll();
    }


    public function getHTML()
    {

        $html = "";

        $url = $this->di->get("url");
        $create = call_user_func([$url, "create"], "user/admincreate");
        $adminupdate = call_user_func([$url, "create"], "user/adminupdate/");
        $del = call_user_func([$url, "create"], "user/admindelete");

        $html .= '<h1>Alla medlemmar</h1>';
        $html .= '<p><span class="button"><a href="' . $create . '">Lägg Till En Medlem</a></span>';
        $html .= '<span class="button"><a href="' . $del . '">Ta bort En Medlem</a></span></p>';


        $html .= '<table class = "user"><tr>
        <th class="userid">Id</th>
        <th class="acronym">Acronym</th>
        <th class="useremail">Email</th>
        <th class="isadmin">Adm</th>
        <th class="created">Skapades</th>
        <th class="updated">Uppdaterades</th>
        <th class="active">Aktiv</th>
        </tr>';

        foreach ($this->users as $value) {
            $html .= '<tr><td>';
            $html .= '<a href="' . $adminupdate . '/' . $value->id . '">' . $value->id . '</a></td>';
            $html .= '<td>' . $value->acronym . '</td>';
            $html .= '<td>' . $value->email . '</td>';
            $html .= '<td>' . $value->isadmin . '</td>';
            $html .= '<td>' . $value->created . '</td>';
            $html .= '<td>' . $value->updated . '</td>';
            $html .= '<td>' . $value->active . '</td></tr>';
        }
        $html .= '</table>';

        return $html;
    }
}
