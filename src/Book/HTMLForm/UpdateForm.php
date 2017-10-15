<?php

namespace Guni\Book\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Guni\Book\Book;

/**
 * Form to update an item.
 */
class UpdateForm extends FormModel
{
    /**
     * Constructor injects with DI container and the id to update.
     *
     * @param Anax\DI\DIInterface $di a service container
     * @param integer             $id to update
     */
    public function __construct(DIInterface $di, $id)
    {
        parent::__construct($di);
        $book = $this->getItemDetails($id);
        
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Uppdatera bokdata",
            ],
            [
                "id" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $book->id,
                ],

                "title" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $book->title,
                    "label"      => "Boktitel",
                ],

                "author" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $book->author,
                    "label"      => "Författare",
                ],

                "imgLink" => [
                    "type" => "text",
                    "value" => $book->imgLink,
                    "label"      => "Bildlänk (bild.jpg)",
                ],

                "bookLink" => [
                    "type" => "text",
                    "value" => $book->bookLink,
                    "label"      => "Boklänk (http)",
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Spara",
                    "callback" => [$this, "callbackSubmit"]
                ],

                "reset" => [
                    "type"      => "reset",
                    "label"      => "Återställ",
                ],
            ]
        );
    }



    /**
     * Get details on item to load form with.
     *
     * @param integer $id get details on item with id.
     *
     * @return Book
     */
    public function getItemDetails($id)
    {
        $book = new Book();
        $book->setDb($this->di->get("db"));
        $book->find("id", $id);
        return $book;
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
        $book->find("id", $this->form->value("id"));
        $book->title = $this->form->value("title");
        $book->author = $this->form->value("author");
        $book->imgLink = $this->form->value("imgLink");
        $book->bookLink = $this->form->value("bookLink");
        $book->save();
        //$this->form->addOutput($book->title . " uppdaterad.");
        $pagerender = $this->di->get("pageRender");
        $pagerender->redirect("book");
    }
}
