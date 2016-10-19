<?php
declare(strict_types=1);

namespace ConfHub;

use \Illuminate\Database\Eloquent\Model;

/**
 * Confs ORM class
 */
class Confs extends Model
{
    /**
     * @var string
     */
    protected $table = 'confs';

    /**
     * @var bool
     */
    public $timestamps = false;

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
