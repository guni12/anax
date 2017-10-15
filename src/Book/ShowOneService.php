<?php

namespace Guni\Book;

use \Anax\DI\DIInterface;
use \Guni\Book\Book;

/**
 * Form to update an item.
 */
class ShowOneService
{
    /**
    * @var array $bookitem, the chosen book.
    */
    protected $bookitem;


    /**
     * Constructor injects with DI container and the id to update.
     *
     * @param Anax\DI\DIInterface $di a service container
     * @param integer             $id to update
     */
    public function __construct(DIInterface $di, $id)
    {
        $this->di = $di;
        $this->bookitem = $this->getItemDetails($id);
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


    public function getHTML()
    {
        $url = $this->di->get("url");
        $imgurl = call_user_func([$url, "create"], "img");
        $img = "";

        if (isset($this->bookitem->imgLink)) {
            $img = $imgurl . '/' . $this->bookitem->imgLink;
        } else {
            $img = $imgurl . '/bok.jpg';
        }

        $book = call_user_func([$url, "create"], "book");

        $html = "";
        $html .= '<div class="col-sm-12 col-xs-12"><div class="col-lg-4 col-sm-7 col-xs-7 abookimg">';
        $html .= '<p class = "abook_last"><a href="';
        $html .= $book . '">Till Alla Böcker</a>';
        $html .= '</p><img src="' . $img . '" /></div>';
        $html .= '<div class="col-sm-5 col-xs-5 abook">';
        $html .= '<h1>' . $this->bookitem->title . '</h1>';
        $html .= $this->bookitem->author;
        $html .= '<br /><br /><a href="';
        $html .= $this->bookitem->bookLink . '">Här kan du köpa den</a>';
        $html .= '</div></div>';

        return $html;
    }
}
