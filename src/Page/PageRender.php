<?php

namespace Guni\Page;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;

/**
 * A default page rendering class.
 */
class PageRender implements PageRenderInterface, InjectionAwareInterface
{
    use InjectionAwareTrait;


    public function redirect($newpage)
    {
        $response = $this->di->get("response");
        $url = $this->di->get("url");
        $response->redirect($url->create($newpage));
    }



    /**
     * Render a standard web page using a specific layout.
     * @SuppressWarnings("exit")
     * @param array   $data   variables to expose to layout view.
     * @param integer $status code to use when delivering the result.
     *
     * @return void
     */
    public function renderPage($text, $meta = null, $status = 200)
    {
        //$req = $this->di->get("request");
        //$path = $req->getRoute();
        //var_dump($meta);
        //var_dump($text);

        if (is_array($text)) {
            if (isset($text['content'])) {
                $text = $text['content'];
            }
            if (isset($text['form'])) {
                $text = $text['form'];
            }
        }
        

        $data["stylesheets"] = isset($meta["stylesheets"]) ? $meta["stylesheets"] : ["css/style.css"];
        $data["title"] = isset($meta["title"]) ? $meta["title"] : "Anax";
        $region = isset($meta['region']) ? $meta['region'] : "main";

        // Add layout, render it, add to response and send.
        $view = $this->di->get("view");

        if (isset($meta['views']['img'])) {
            $view->add("view/img", [
                "img" => $meta['views']['img']['data']['src'],
                "imgtext" => $meta['views']['img']['data']['text']
            ], $meta['views']['img']['region'], 0);
        }

        if (isset($meta['views']['links'])) {
            $view->add($meta['views']['links']['template'], [
                "headline" => $meta['views']['links']['data']['headline'],
            ], $meta['views']['links']['region'], 0);
        }

        /*
        $comm = $this->di->get("comm");

        if ($path == 'commpage') {
            $comm->addComment();
            $comm->getCommFromSess();
            //$comm->getCommFromJson();
        }

        if ($path == 'validate') {
            $comm->inValidate();
        }*/

        $navbar = $this->di->get("navbar");

        // Add common header, navbar and footer
        $view->add("view/header", [], "header");
        $view->add("view/navbar", [
            "navbar" => $navbar->getHTML()
        ], "navbar", 0);
        $view->add("view/footer", [
            "footeradd" => "<br /><br />"
        ], "footer", 1);
        $view->add("default1/article", [
                "content" => $text
            ], $region, 0);
        
        $view->add("view/layout", $data, "layout");
        $body = $view->renderBuffered("layout");

        $this->di->get("response")->setBody($body)
                                  ->send($status);
        exit;
    }
}
