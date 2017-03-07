<?php

namespace Marketplace\Packages\Prices\Code\Tables;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prices
 *
 * @ORM\Table(name="marketplace_packages_prices", indexes={@ORM\Index(name="package_id_index", columns={"package_id"}), @ORM\Index(name="created_by_index", columns={"created_by"}), @ORM\Index(name="modified_by_index", columns={"modified_by"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Prices extends \Kazist\Table\BaseTable {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer", length=11, nullable=false)
     */
    protected $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="package_id", type="integer", length=11, nullable=false)
     */
    protected $package_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="no_of_days", type="integer", length=11, nullable=true)
     */
    protected $no_of_days;

    /**
     * @var integer
     *
     * @ORM\Column(name="featured", type="integer", length=11, nullable=true)
     */
    protected $featured;

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
    public function getId() {
        return $this->id;
    }

    /**
     * Set price
     *
     * @param integer $price
     * @return Prices
     */
    public function setPrice($price) {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * Set package_id
     *
     * @param integer $packageId
     * @return Prices
     */
    public function setPackageId($packageId) {
        $this->package_id = $packageId;

        return $this;
    }

    /**
     * Get package_id
     *
     * @return integer 
     */
    public function getPackageId() {
        return $this->package_id;
    }

    /**
     * Set no_of_days
     *
     * @param integer $noOfDays
     * @return Prices
     */
    public function setNoOfDays($noOfDays) {
        $this->no_of_days = $noOfDays;

        return $this;
    }

    /**
     * Get no_of_days
     *
     * @return integer 
     */
    public function getNoOfDays() {
        return $this->no_of_days;
    }

    /**
     * Set featured
     *
     * @param integer $featured
     * @return Prices
     */
    public function setFeatured($featured) {
        $this->featured = $featured;

        return $this;
    }

    /**
     * Get featured
     *
     * @return integer 
     */
    public function getFeatured() {
        return $this->featured;
    }

    /**
     * Set published
     *
     * @param integer $published
     * @return Prices
     */
    public function setPublished($published) {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return integer 
     */
    public function getPublished() {
        return $this->published;
    }

    /**
     * Get created_by
     *
     * @return integer 
     */
    public function getCreatedBy() {
        return $this->created_by;
    }

    /**
     * Get date_created
     *
     * @return \DateTime 
     */
    public function getDateCreated() {
        return $this->date_created;
    }

    /**
     * Get modified_by
     *
     * @return integer 
     */
    public function getModifiedBy() {
        return $this->modified_by;
    }

    /**
     * Get date_modified
     *
     * @return \DateTime 
     */
    public function getDateModified() {
        return $this->date_modified;
    }

}
