<?php

namespace Guni\App;

/**
 * An App class to wrap the resources of the framework.
 *
 * @SuppressWarnings(PHPMD.ExitExpression)
 */
class App
{
    public function redirect($url)
    {
        $this->response->redirect($this->url->create($url));
        exit;
    }



    /**
     * Render a standard web page using a specific layout.
     */
    public function renderPage($text, $meta, $status = 200)
    {
        //$path = $this->request->getRoute();
        //var_dump($meta);

        $data["stylesheets"] = ["css/style.css",
                                "css/remserver.css"];

        $data["stylesheets"] = isset($meta["stylesheets"]) ? $meta["stylesheets"] : ["css/style.css"];
        $data["title"] = isset($meta["title"]) ? $meta["title"] : ["Anax"];
        $region = isset($meta['region']) ? $meta['region'] : "main";

        if (isset($meta['views']['img'])) {
            $this->view->add("view/img", [
                "img" => $meta['views']['img']['data']['src'],
                "imgtext" => $meta['views']['img']['data']['text']
            ], $meta['views']['img']['region'], 0);
        }

        if (isset($meta['views']['links'])) {
            $this->view->add($meta['views']['links']['template'], [
                "headline" => $meta['views']['links']['data']['headline'],
            ], $meta['views']['links']['region'], 0);
        }

        /*
        if ($path == 'commpage') {
            $this->comm->addComment();
            $this->comm->getCommFromSess();
            $this->comm->getCommFromJson();
        }

        if ($path == 'validate') {
            $this->comm->inValidate();
        }*/

        // Add common header, navbar and footer
        //$this->view->add("default1/header", [], "header");
        //$this->view->add("default1/navbar", [], "navbar");
        //$this->view->add("default1/footer", [], "footer");

        // Add common header, navbar and footer
        $this->view->add("view/header", [], "header");
        $this->view->add("view/navbar", [
            "navbar" => $this->navbar->getHTML()
        ], "navbar", 0);
        $this->view->add("view/footer", [
            "footeradd" => "<br /><br />"
        ], "footer", 1);
        $this->view->add("default1/article", [
                "content" => $text
            ], $region, 0);

        // Add layout, render it, add to response and send.
        $this->view->add("view/layout", $data, "layout");
        $body = $this->view->renderBuffered("layout");
        $this->response->setBody($body)
                       ->send($status);
        exit;
    }
}
