<?php

/**
 * Queue class
 *
 * PHP version 7.0
 */
class Queue
{

    /**
     * Path to the saved files
     *
     * @var string
     */
    protected $path;

    /**
     * Class constructor
     *
     * @param string $path Path to the saved files
     *
     * @return void
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Send an item to the queue
     *
     * @param mixed $content The content to be sent
     *
     * @return mixed The number of bytes written to the queue, or false on failure
     */
    public function push($content)
    {
        $file = $this->path . uniqid('', true);
        $data = serialize($content);

        return file_put_contents($file, $data);
    }

    /**
     * Get the next item from the queue
     *
     * @return mixed The item or null if no more items
     */
    public function getNextItem()
    {
        $filenames = scandir($this->path);
        $filenames = array_diff($filenames, ['.', '..']);  // remove the dots from Linux environments

        $filename = array_shift($filenames);
        if ($filename !== null) {

            $file = $this->path . $filename;

            $contents = file_get_contents($file);
            if ($contents !== false) {

                $object = unserialize($contents);
                if ($object !== false) {

                    unlink($file);

                    return $object;
                }
            }
        }
    }
}
