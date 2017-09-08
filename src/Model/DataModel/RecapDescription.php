<?php
namespace NYPL\Services\Model\DataModel;

use NYPL\Starter\Model;
use NYPL\Starter\Model\ModelTrait\TranslateTrait;

/**
 * @SWG\Definition(type="object", required={"code"})
 */
class RecapDescription extends Model
{
    use TranslateTrait;

    /**
     * @SWG\Property(example="Some sing, some cry")
     * @var string
     */
    public $title = '';

    /**
     * @SWG\Property(example="Ifa Bayeza")
     * @var string
     */
    public $author = '';

    /**
     * @SWG\Property(example="|h*ONPA 84-446")
     * @var string
     */
    public $callNumber = '';

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getCallNumber()
    {
        return $this->callNumber;
    }

    /**
     * @param string $callNumber
     */
    public function setCallNumber($callNumber)
    {
        $this->callNumber = $callNumber;
    }
}
