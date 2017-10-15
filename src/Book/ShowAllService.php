<?php

namespace Guni\Book;

use \Anax\DI\DIInterface;
use \Guni\Book\Book;

/**
 * Form to update an item.
 */
class ShowAllService
{
    /**
    * @var array $bookitem, the chosen book.
    */
    protected $books;


    /**
     * Constructor injects with DI container and the id to update.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di)
    {
        $this->di = $di;
        $this->books = $this->getAll();
    }


    /**
     * Get details on comments.
     *
     *
     * @return All comments
     */
    public function getAll()
    {
        $book = new Book();
        $book->setDb($this->di->get("db"));
        return $book->findAll();
    }


    public function getHTML()
    {
        $url = $this->di->get("url");
        $create = call_user_func([$url, "create"], "book/create");
        $delete = call_user_func([$url, "create"], "book/delete");
        $update = call_user_func([$url, "create"], "book/update");
        $viewone = call_user_func([$url, "create"], "book/view-one");

        $booklink = "";
        $html = "";
        $html .= '<h1>Boksamlingen</h1>';
        $html .= '<p><span class="button"><a href="' . $create . '">Lägg Till En Bok</a></span>';
        $html .= '<span class="button"><a href="' . $delete . '">Ta bort En Bok</a></span></p>';
        $html .= '<table class = "bok">
            <tr>
                <th class="bookid">Id</th>
                <th class="title">Titel</th>
                <th class="author">Författare</th>
                <th class="booklink">Köp den</th>
            </tr>';

        foreach ($this->books as $item) {
            if (isset($item->bookLink) && $item->bookLink != "") {
                $booklink = $item->bookLink;
            } else {
                $booklink = "";
            }
            $html .= '<tr><td><a href="' . $update . '/' . $item->id . '">';
            $html .= $item->id . '</a></td>';
            $html .= '<td><a href="' . $viewone . '/' . $item->id . '">';
            $html .= $item->title . '</a></td>';
            $html .= '<td>' . $item->author . '</td>';
            $html .= '<td><a href="' . $booklink . '">' . $booklink . '</a></td></tr>';
        }
        $html .= '</table>';
        
        return $html;
    }
}
