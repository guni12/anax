<?php

namespace Guni\RemServer;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;

/**
 * REM Server.
 */
class RemServer implements ConfigureInterface
{
    use ConfigureTrait;



    /**
     * @var array $session inject a reference to the session.
     */
    private $session;



    /**
     * @var string $key to use when storing in session.
     */
    const KEY = "remserver";



    /**
     * Inject dependencies.
     *
     * @param array $dependency key/value array with dependencies.
     *
     * @return self
     */
    public function inject($dependency)
    {
        $this->session = $dependency["session"];
        return $this;
    }



    /**
     * Fill the session with default data that are read from files.
     *
     * @return self
     */
    public function init()
    {
        $files = $this->config["dataset"];
        //var_dump($files);
        $dataset = [];
        foreach ($files as $file) {
            $content = file_get_contents($file);
            $key = pathinfo($file, PATHINFO_FILENAME);
            $dataset[$key] = json_decode($content, true);
            //var_dump($dataset[$key]); // filecontent when initiated
        }

        $this->session->set(self::KEY, $dataset);
        return $this;
    }



    /**
     * Check if there is a dataset stored.
     *
     * @return boolean tru if dataset exists in session, else false
     */
    public function hasDataset()
    {
        return($this->session->has(self::KEY));
    }



    /**
     * Get (or create) a subset of data.
     *
     * @param string $key for data subset.
     *
     * @return array with the dataset
     */
    public function getDataset($key)
    {
        $data = $this->session->get(self::KEY);
        $set = isset($data[$key])
            ? $data[$key]
            : [];
        return $set;
    }



    /**
     * Save (the modified) dataset.
     *
     * @param string $key     for data subset.
     * @param string $dataset the data to save.
     *
     * @return self
     */
    public function saveDataset($key, $dataset)
    {
        $data = $this->session->get(self::KEY);
        $data[$key] = $dataset;
        $this->session->set(self::KEY, $data);
        $data = $this->session->get(self::KEY);
        //var_dump($data);
        return $this;
    }



    /**
     * Save (the modified) dataset to file.
     *
     * @param string $key     for data subset.
     * @param string $dataset the data to save.
     *
     * @return self
     */
    public function saveToFile($key, $dataset)
    {
        $path = ANAX_APP_PATH . "/config/remserver/" . $key . ".json";
        $content = file_get_contents($path);
        //var_dump($content);
        $tempArray = json_decode($content);
        //var_dump($tempArray);
        $max = 0;
        $repeat = false;
        foreach ($tempArray as $val) {
            if ($max < (int)$val["id"]) {
                $max = (int)$val["id"];
            }
            if ($val["comment"] == $dataset["comment"]) {
                $repeat = true;
            }
        }
        if ($repeat == false) {
            $nrOfPosts = count($tempArray) + 1;
            $dataset['id'] = $nrOfPosts;
            array_push($tempArray, $dataset);
            //var_dump($tempArray);
            $jsonData = json_encode($tempArray, JSON_PRETTY_PRINT);
            //var_dump($jsonData);
            file_put_contents($path, $jsonData);
        }
    }



    /**
     * Get an item from a dataset.
     *
     * @param string $key    for the dataset
     * @param string $itemId for the item to get
     *
     * @return array|null array with item if found, else null
     */
    public function getItem($key, $itemId)
    {
        $dataset = $this->getDataset($key);

        foreach ($dataset as $item) {
            if ((int)$item["id"] === (int)$itemId) {
                return $item;
            }
        }
        return null;
    }



    /**
     * Add an item to a dataset.
     *
     * @param string $key  for the dataset
     * @param string $item to add
     *
     * @return array as new item inserted
     */
    public function addItem($key, $item)
    {
        $dataset = $this->getDataset($key);

        // Get max value for the id
        $max = 0;
        $repeat = false;
        foreach ($dataset as $val) {
            if ($max < (int)$val["id"]) {
                $max = (int)$val["id"];
            }
            if ($val["comment"] == $item["comment"]) {
                $repeat = true;
            }
        }
        if ($repeat == false) {
            $item["id"] = $max + 1;
            $dataset[] = $item;
            $this->saveDataset($key, $dataset);
            return $item;
        }
    }



    /**
     * Upsert/replace an item to a dataset.
     *
     * @param string $key    for the dataset
     * @param string $itemId where to store it
     * @param string $entry  to add
     *
     * @return array as item upserted
     */
    public function upsertItem($keyDataset, $itemId, $entry)
    {
        $dataset = $this->getDataset($keyDataset);
        $entry["id"] = $itemId;

        // Find the item if it exists
        $found = false;
        foreach ($dataset as $key => $val) {
            if ((int)$itemId === (int)$val["id"]) {
                $dataset[$key] = $entry;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $dataset[] = $entry;
        }

        $this->saveDataset($keyDataset, $dataset);
        return $entry;
    }



    /**
     * Delete an item from the dataset.
     *
     * @param string $key    for the dataset
     * @param string $itemId to delete
     *
     * @return void
     */
    public function deleteItem($keyDataset, $itemId)
    {
        $dataset = $this->getDataset($keyDataset);
        // Find the item if it exists
        foreach ($dataset as $key => $val) {
            var_dump((int)$itemId, (int)$val["id"]);
            if ((int)$itemId === (int)$val["id"]) {
                unset($dataset[$key]);
                break;
            }
        }
        $this->saveDataset($keyDataset, $dataset);
    }
}
