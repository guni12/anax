<?php

namespace Guni\RemServer;

use \Anax\Common\AppInjectableInterface;
use \Anax\Common\AppInjectableTrait;

/**
 * A controller for the REM Server.
 *
 * @SuppressWarnings(PHPMD.ExitExpression)
 */
class RemServerController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * Start the session and initiate the REM Server.
     *
     * @return void
     */
    public function anyPrepare()
    {
        //$this->app->session->start();
        //$data = $this->app->session->get("api");
        //var_dump($data);

        if (!$this->app->rem->hasDataset()) {
            $this->app->rem->init();
        }
    }



    /**
     * Init or re-init the REM Server.
     *
     * @return void
     */
    public function anyInit()
    {
        $this->app->rem->init();
        $this->app->response->sendJson(["message" => "The session is initiated with the default dataset."]);
        exit;
    }



    /**
     * Destroy the session.
     *
     * @return void
     */
    public function anyDestroy()
    {
        $this->app->session->destroy();
        $this->app->response->sendJson(["message" => "The session was destroyed."]);
        exit;
    }



    /**
     * Get the dataset or parts of it.
     *
     * @param string $key for the dataset
     *
     * @return void
     */
    public function getDataset($key)
    {
        $dataset = $this->app->rem->getDataset($key);
        $offset = $this->app->request->getGet("offset", 0);
        $limit = $this->app->request->getGet("limit", 25);
        $res = [
            "data" => array_slice($dataset, $offset, $limit),
            "offset" => $offset,
            "limit" => $limit,
            "total" => count($dataset)
        ];
        //var_dump($res['data']);
/*<pre class='xdebug-var-dump' dir='ltr'>
C:\Users\Gunvor\Documents\code\p\dbwebb-kurser\ramverk1\me\anax\src\RemServer\RemServerController.php:81
array (size=2) 
  0: 
array (size=3) 
    'id': int 1 
    'header': string 'Kmom01' (length=6)
    'text' string 'Brödtext för kmom01' (length=21) 
  1:  
array (size=3)
    'id': int 2
    'header': string 'Kmom02' (length=6)
    'text': string 'Brödtext för kmom02' (length=21)*/

        $this->app->response->sendJson($res);
        exit;
    }



    /**
     * Get one item from the dataset.
     *
     * @param string $key    for the dataset
     * @param string $itemId for the item to get
     *
     * @return void
     */
    public function getItem($key, $itemId)
    {
        $item = $this->app->rem->getItem($key, $itemId);
        if (!$item) {
            $this->app->response->sendJson(["message" => "The item is not found."]);
            exit;
        }

        $this->app->response->sendJson($item);
        exit;
    }



    /**
     * Create a new item by getting the entry from the request body and add
     * to the dataset.
     *
     * @param string $key    for the dataset
     *
     * @return void
     */
    public function postItem($key)
    {
        $entry = $this->app->request->getBody();
        $entry = json_decode($entry, true);

        $item = $this->app->rem->addItem($key, $entry);
        $this->app->response->sendJson($item);
        exit;
    }


    /**
     * Upsert/replace an item in the dataset, entry is taken from request body.
     *
     * @param string $key    for the dataset
     * @param string $itemId where to save the entry
     *
     * @return void
     */
    public function putItem($key, $itemId)
    {
        $entry = $this->app->request->getBody();
        $entry = json_decode($entry, true);

        $item = $this->app->rem->upsertItem($key, $itemId, $entry);
        $this->app->response->sendJson($item);
        exit;
    }



    /**
     * Delete an item from the dataset.
     *
     * @param string $key    for the dataset
     * @param string $itemId for the item to delete
     *
     * @return void
     */
    public function deleteItem($key, $itemId)
    {
        $this->app->rem->deleteItem($key, $itemId);
        $this->app->response->sendJson(null);
        exit;
    }



    /**
     * Show a message that the route is unsupported, a local 404.
     *
     * @return void
     */
    public function anyUnsupported()
    {
        $this->app->response->sendJson(["message" => "404. The api/ does not support that."], 404);
        exit;
    }
}
