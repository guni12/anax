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
            //echo $file;
            //echo "<br />";
            $content = file_get_contents($file);
            //echo $content;
            $key = pathinfo($file, PATHINFO_FILENAME);
            //echo $key;
            $dataset[$key] = json_decode($content, true);
            //var_dump($dataset[$key]);
        }

        $this->session->set(self::KEY, $dataset);
        //var_dump($this->session);
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
        return $this;
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
            if ($item["id"] === $itemId) {
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
        foreach ($dataset as $val) {
            if ($max < $val["id"]) {
                $max = $val["id"];
            }
        }
        $item["id"] = $max + 1;
        $dataset[] = $item;
        $this->saveDataset($key, $dataset);
        return $item;
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
            if ($itemId === $val["id"]) {
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
            if ($itemId === $val["id"]) {
                unset($dataset[$key]);
                break;
            }
        }
        $this->saveDataset($keyDataset, $dataset);
    }
}
