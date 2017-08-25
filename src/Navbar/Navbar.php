<?php

namespace Guni\Navbar;

/**
 * Navbar to generate HTML for a navbar from a configuration array.
 */
class Navbar implements
    \Anax\Common\ConfigureInterface,
    \Anax\Common\AppInjectableInterface
{
    use \Anax\Common\ConfigureTrait,
        \Anax\Common\AppInjectableTrait;

    /**
     * Get HTML for the navbar.
     *
     * @return string as HTML with the navbar.
     */
    public function getHTML()
    {
        $classval = $this->config['config']['navbar-class'];
        $divcon = $this->config['config']['div-container'];
        $divnav = $this->config['config']['div-nav'];
        $spanicon = $this->config['config']['span-icon'];
        $home = $this->config['items']['hem']['route'];
        $links = "";

        foreach ($this->config['items'] as $val) {
            $links .= '<li><a href="'. $val['route'] . '">' . $val['text'] . '</a></li>';
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
        //var_dump($navbar);

        return
        $navbar;
    }

    /**
     * Sets the current route.
     *
     * @param string $route the current route.
     *
     * @return void
     * add $route later
     */
    public function setCurrentRoute()
    {
        ;
    }

    /**
     * Sets the callable to use for creating routes.
     *
     * @param callable $urlCreate to create framework urls.
     *
     * @return void
     * add $urlCreate later
     */
    public function setUrlCreator()
    {
        ;
    }
}
