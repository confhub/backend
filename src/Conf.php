<?php
declare(strict_types=1);

namespace ConfHub;

/**
 * Conf class
 */
class Conf
{
    /**
     * @var string Conf title
     */
    private $title;

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }
}
