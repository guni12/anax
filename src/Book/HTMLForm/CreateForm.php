<?php

namespace Guni\Book\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Guni\Book\Book;

/**
 * Form to create an item.
 */
class CreateForm extends FormModel
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
                "legend" => "Bok data",
            ],
            [
                "title" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "label"      => "Boktitel",
                ],

                "author" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "label"      => "Författare",
                ],

                "imgLink" => [
                    "type" => "text",
                    "label"      => "Bildlänk (bild.jpg)",
                ],

                "bookLink" => [
                    "type" => "text",
                    "label"      => "Boklänk (http)",
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Spara boken",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
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
        $book->title = $this->form->value("title");
        $book->author = $this->form->value("author");
        $book->imgLink = $this->form->value("imgLink");
        $book->bookLink = $this->form->value("bookLink");
        $book->save();
        //$this->form->addOutput($book->title . " sparad.");
        $pagerender = $this->di->get("pageRender");
        $pagerender->redirect("book");
    }
}
