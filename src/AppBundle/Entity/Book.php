<?php

namespace AppBundle\Entity;

/**
 * Book
 */
class Book
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $cat;

    /**
     * @var string
     */
    private $author;

    /**
     * @var int
     */
    private $sSN;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Book
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set cat
     *
     * @param string $cat
     *
     * @return Book
     */
    public function setCat($cat)
    {
        $this->cat = $cat;

        return $this;
    }

    /**
     * Get cat
     *
     * @return string
     */
    public function getCat()
    {
        return $this->cat;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Book
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set sSN
     *
     * @param integer $sSN
     *
     * @return Book
     */
    public function setSSN($sSN)
    {
        $this->sSN = $sSN;

        return $this;
    }

    /**
     * Get sSN
     *
     * @return int
     */
    public function getSSN()
    {
        return $this->sSN;
    }
}

