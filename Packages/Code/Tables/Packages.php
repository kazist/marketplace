<?php

namespace Marketplace\Packages\Code\Tables;

use Doctrine\ORM\Mapping as ORM;

/**
 * Packages
 *
 * @ORM\Table(name="marketplace_packages", indexes={@ORM\Index(name="created_by_index", columns={"created_by"}), @ORM\Index(name="modified_by_index", columns={"modified_by"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Packages extends \Kazist\Table\BaseTable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="has_currency", type="integer", length=11, nullable=true)
     */
    protected $has_currency;

    /**
     * @var integer
     *
     * @ORM\Column(name="has_price", type="integer", length=11, nullable=true)
     */
    protected $has_price;

    /**
     * @var integer
     *
     * @ORM\Column(name="has_discount", type="integer", length=11, nullable=true)
     */
    protected $has_discount;

    /**
     * @var integer
     *
     * @ORM\Column(name="published", type="integer", length=11, nullable=true)
     */
    protected $published;

    /**
     * @var integer
     *
     * @ORM\Column(name="created_by", type="integer", length=11, nullable=false)
     */
    protected $created_by;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="datetime", nullable=false)
     */
    protected $date_created;

    /**
     * @var integer
     *
     * @ORM\Column(name="modified_by", type="integer", length=11, nullable=false)
     */
    protected $modified_by;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_modified", type="datetime", nullable=false)
     */
    protected $date_modified;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Packages
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Packages
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set has_currency
     *
     * @param integer $hasCurrency
     * @return Packages
     */
    public function setHasCurrency($hasCurrency)
    {
        $this->has_currency = $hasCurrency;

        return $this;
    }

    /**
     * Get has_currency
     *
     * @return integer 
     */
    public function getHasCurrency()
    {
        return $this->has_currency;
    }

    /**
     * Set has_price
     *
     * @param integer $hasPrice
     * @return Packages
     */
    public function setHasPrice($hasPrice)
    {
        $this->has_price = $hasPrice;

        return $this;
    }

    /**
     * Get has_price
     *
     * @return integer 
     */
    public function getHasPrice()
    {
        return $this->has_price;
    }

    /**
     * Set has_discount
     *
     * @param integer $hasDiscount
     * @return Packages
     */
    public function setHasDiscount($hasDiscount)
    {
        $this->has_discount = $hasDiscount;

        return $this;
    }

    /**
     * Get has_discount
     *
     * @return integer 
     */
    public function getHasDiscount()
    {
        return $this->has_discount;
    }

    /**
     * Set published
     *
     * @param integer $published
     * @return Packages
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return integer 
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Get created_by
     *
     * @return integer 
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * Get date_created
     *
     * @return \DateTime 
     */
    public function getDateCreated()
    {
        return $this->date_created;
    }

    /**
     * Get modified_by
     *
     * @return integer 
     */
    public function getModifiedBy()
    {
        return $this->modified_by;
    }

    /**
     * Get date_modified
     *
     * @return \DateTime 
     */
    public function getDateModified()
    {
        return $this->date_modified;
    }
    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        // Add your code here
    }
}
