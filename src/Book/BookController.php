<?php

namespace Guni\Book;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Guni\Book\HTMLForm\CreateForm;
use \Guni\Book\HTMLForm\EditForm;
use \Guni\Book\HTMLForm\DeleteForm;
use \Guni\Book\HTMLForm\UpdateForm;
use \Guni\Book\ShowOneService;
use \Guni\Book\ShowAllService;

/**
 * A controller class.
 */
class BookController implements
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
     * Show all items.
     *
     * @return void
     */
    public function getIndex()
    {
        $title      = "Böcker";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $book = new Book();
        $book->setDb($this->di->get("db"));

        $text       = new ShowAllService($this->di);

        $data = [
            //"items" => $book->findAll(),
            "items" => $text->getHTML(),
        ];

        $view->add("book/crud/view-all", $data);
        $tempfix = "";

        $pageRender->renderPage($tempfix, ["title" => $title]);
    }



    /**
     * Handler with form to create a new item.
     *
     * @return void
     */
    public function getPostCreateItem()
    {
        $title      = "Lägg till en bok";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new CreateForm($this->di);

        $form->check();

        $data = [
            "form" => $form->getHTML(),
        ];

        $view->add("book/crud/create", $data);
        $tempfix = "";

        $pageRender->renderPage($tempfix, ["title" => $title]);
    }



    /**
     * Handler with form to delete an item.
     *
     * @return void
     */
    public function getPostDeleteItem()
    {
        $title      = "Kasta en bok";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new DeleteForm($this->di);

        $form->check();

        $data = [
            "form" => $form->getHTML(),
        ];

        $view->add("book/crud/delete", $data);
        $tempfix = "";

        $pageRender->renderPage($tempfix, ["title" => $title]);
    }



    /**
     * Handler with form to update an item.
     *
     * @return void
     */
    public function getPostUpdateItem($id)
    {
        $title      = "Uppdatera en bok";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new UpdateForm($this->di, $id);

        $form->check();

        $data = [
            "form" => $form->getHTML(),
        ];

        $view->add("book/crud/update", $data);
        $tempfix = "";

        $pageRender->renderPage($tempfix, ["title" => $title]);
    }


    /**
     * Handler with form to just show an item.
     *
     * @return void
     */
    public function getPostShow($id)
    {
        $title      = "Se en bok";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $text       = new ShowOneService($this->di, $id);

        $data = [
            "html" => $text->getHTML(),
        ];

        $view->add("book/crud/view-one", $data);
        $tempfix = "";

        $pageRender->renderPage($tempfix, ["title" => $title]);
    }
}
