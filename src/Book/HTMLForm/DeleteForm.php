<?php

namespace Guni\Book\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Guni\Book\Book;

/**
 * Form to delete an item.
 */
class DeleteForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di)
    {
        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Till papperskorgen",
            ],
            [
                "select" => [
                    "type"        => "select",
                    "label"       => "Välj en bok att slänga:",
                    "options"     => $this->getAllItems(),
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Kasta boken",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Get all items as array suitable for display in select option dropdown.
     *
     * @return array with key value of all items.
     */
    protected function getAllItems()
    {
        $book = new Book();
        $book->setDb($this->di->get("db"));

        $books = ["-1" => "Välj en bok..."];
        foreach ($book->findAll() as $obj) {
            $books[$obj->id] = "{$obj->title} ({$obj->id})";
        }

        return $books;
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        $book = new Book();
        $book->setDb($this->di->get("db"));
        $book->find("id", $this->form->value("select"));
        $book->delete();
        //$this->form->addOutput($title . " kastad.");
        $pagerender = $this->di->get("pageRender");
        $pagerender->redirect("book");
    }
}
