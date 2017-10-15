<?php

namespace Guni\Navbar;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;

/**
 * Navbar to generate HTML for a navbar from a configuration array.
 */
class Navbar implements
    \Anax\Common\ConfigureInterface,
    //\Anax\Common\AppInjectableInterface,
    InjectionAwareInterface
{
    use InjectionAwareTrait, \Anax\Common\ConfigureTrait;
    // \Anax\Common\AppInjectableTrait;

    private $currentUrl;
    private $htmlNavbar;


    /**
     * Get HTML for the navbar.
     *
     * @return string as HTML with the navbar.
     */
    public function getHTML()
    {
        $url = $this->di->get("url");
        $req = $this->di->get("request");
        $path = $req->getRoute();

        $session = $this->di->get("session");
        $sess = $session->get('user');
        //var_dump($sess);

        $classval = $this->config['config']['navbar-class'];
        $divcon = $this->config['config']['div-container'];
        $divnav = $this->config['config']['div-nav'];
        $spanicon = $this->config['config']['span-icon'];
        $links = "";
        $tail = '"><a href="';
        $welcome = "";

        $this->setUrlCreator($this->config['items']['hem']['route']);
        $home = $this->htmlNavbar;

        $navtext = "Logga in";
        $navpath = call_user_func([$url, "create"], "user/login");

        if ($sess) {
            $navtext = "Logga ut";
            $navpath = call_user_func([$url, "create"], "user/logout");
            $welcome = $sess['acronym'];
        }

        $loginout = '<li><a><span class="glyphicon glyphicon-user"></span> ' . $welcome . '</a></li>
              <li><a href="' . $navpath . '"><span class="glyphicon glyphicon-log-in"></span> ' . $navtext . '</a></li>';


        foreach ($this->config['items'] as $val) {
            $this->setUrlCreator($val['route']);
            $navtext = $val['text'];
            
            if ($val['route'] == $path) {
                $class = "active";
            } else {
                $class = "";
            }

            if ($val['route'] == "user/login") {
                $class .= " login";
            }
            
            $links .= '<li class="' . $class . $tail . $this->htmlNavbar . '">' . $navtext . '</a></li>';
        }
        
        $navbar = <<<EOD
<nav class="{$classval}">
<div class="{$divcon}">
<div class="{$divnav}">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="{$spanicon}"></span>
        <span class="{$spanicon}"></span>
        <span class="{$spanicon}"></span>                        
    </button>
    <a class="navbar-brand" href="{$home}">HosGuni</a>
</div>
<ul class="nav navbar-nav navbar-right">
   {$loginout}   
</ul>
<div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
        {$links}
    </ul>
</div>
</div>
</nav>
EOD;
        return
        $navbar;
    }

    /**
     * Sets the current route.
     *
     * @param string $route the current route.
     *
     * @return void
     */
    public function setCurrentRoute($route)
    {
        $this->currentUrl = $route;
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
        $this->htmlNavbar = call_user_func([$url, "create"], $route);
    }
}
