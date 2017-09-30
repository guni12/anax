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
        //var_dump($path);

        $classval = $this->config['config']['navbar-class'];
        $divcon = $this->config['config']['div-container'];
        $divnav = $this->config['config']['div-nav'];
        $spanicon = $this->config['config']['span-icon'];
        $links = "";
        $active = "";
        $tail = '"><a href="';

        $this->setUrlCreator([$url, "create"], $this->config['items']['hem']['route']);
        $home = $this->htmlNavbar;

        foreach ($this->config['items'] as $val) {
            $this->setUrlCreator([$url, "create"], $val['route']);
            
            if ($val['route'] == $path) {
                $active = "active";
            } else {
                $active = "";
            }
            $links .= '<li class="' . $active . $tail . $this->htmlNavbar . '">' . $val['text'] . '</a></li>';
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
    public function setUrlCreator($urlCreate, $route)
    {
        $this->htmlNavbar = call_user_func($urlCreate, $route);
    }
}
