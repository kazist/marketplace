<?php

namespace Marketplace\Adverts\Code\Tables;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adverts
 *
 * @ORM\Table(name="marketplace_adverts", indexes={@ORM\Index(name="category_id_index", columns={"category_id"}), @ORM\Index(name="country_id_index", columns={"country_id"}), @ORM\Index(name="currency_id_index", columns={"currency_id"}), @ORM\Index(name="package_id_index", columns={"package_id"}), @ORM\Index(name="package_price_id_index", columns={"package_price_id"}), @ORM\Index(name="created_by_index", columns={"created_by"}), @ORM\Index(name="modified_by_index", columns={"modified_by"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Adverts extends \Kazist\Table\BaseTable
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
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer", length=11, nullable=true)
     */
    protected $category_id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    protected $image;

    /**
     * @var integer
     *
     * @ORM\Column(name="country_id", type="integer", length=11, nullable=true)
     */
    protected $country_id;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="text", nullable=true)
     */
    protected $city;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer", length=11, nullable=true)
     */
    protected $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="discounted_price", type="integer", length=11, nullable=true)
     */
    protected $discounted_price;

    /**
     * @var integer
     *
     * @ORM\Column(name="currency_id", type="integer", length=11, nullable=true)
     */
    protected $currency_id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sale_start_date", type="datetime", nullable=true)
     */
    protected $sale_start_date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sale_end_date", type="datetime", nullable=true)
     */
    protected $sale_end_date;

    /**
     * @var integer
     *
     * @ORM\Column(name="published", type="integer", length=11, nullable=true)
     */
    protected $published;

    /**
     * @var integer
     *
     * @ORM\Column(name="featured", type="integer", length=11, nullable=true)
     */
    protected $featured;

    /**
     * @var integer
     *
     * @ORM\Column(name="hit", type="integer", length=11, nullable=true)
     */
    protected $hit;

    /**
     * @var integer
     *
     * @ORM\Column(name="latitude", type="integer", length=11, nullable=true)
     */
    protected $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=255, nullable=true)
     */
    protected $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="business_name", type="string", length=255, nullable=true)
     */
    protected $business_name;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255, nullable=true)
     */
    protected $website;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    protected $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    protected $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="payment_amount", type="integer", length=11, nullable=true)
     */
    protected $payment_amount;

    /**
     * @var integer
     *
     * @ORM\Column(name="payment_status", type="integer", length=11, nullable=true)
     */
    protected $payment_status;

    /**
     * @var string
     *
     * @ORM\Column(name="payment_stage", type="string", length=255, nullable=true)
     */
    protected $payment_stage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="payment_expiry", type="datetime", nullable=true)
     */
    protected $payment_expiry;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="payment_date", type="datetime", nullable=true)
     */
    protected $payment_date;

    /**
     * @var string
     *
     * @ORM\Column(name="business_logo", type="string", length=255, nullable=true)
     */
    protected $business_logo;

    /**
     * @var integer
     *
     * @ORM\Column(name="package_id", type="integer", length=11, nullable=true)
     */
    protected $package_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="package_price_id", type="integer", length=11, nullable=true)
     */
    protected $package_price_id;

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
     * @return Adverts
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
     * Set category_id
     *
     * @param integer $categoryId
     * @return Adverts
     */
    public function setCategoryId($categoryId)
    {
        $this->category_id = $categoryId;

        return $this;
    }

    /**
     * Get category_id
     *
     * @return integer 
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Adverts
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
     * Set image
     *
     * @param string $image
     * @return Adverts
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set country_id
     *
     * @param integer $countryId
     * @return Adverts
     */
    public function setCountryId($countryId)
    {
        $this->country_id = $countryId;

        return $this;
    }

    /**
     * Get country_id
     *
     * @return integer 
     */
    public function getCountryId()
    {
        return $this->country_id;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Adverts
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set price
     *
     * @param integer $price
     * @return Adverts
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set discounted_price
     *
     * @param integer $discountedPrice
     * @return Adverts
     */
    public function setDiscountedPrice($discountedPrice)
    {
        $this->discounted_price = $discountedPrice;

        return $this;
    }

    /**
     * Get discounted_price
     *
     * @return integer 
     */
    public function getDiscountedPrice()
    {
        return $this->discounted_price;
    }

    /**
     * Set currency_id
     *
     * @param integer $currencyId
     * @return Adverts
     */
    public function setCurrencyId($currencyId)
    {
        $this->currency_id = $currencyId;

        return $this;
    }

    /**
     * Get currency_id
     *
     * @return integer 
     */
    public function getCurrencyId()
    {
        return $this->currency_id;
    }

    /**
     * Set sale_start_date
     *
     * @param \DateTime $saleStartDate
     * @return Adverts
     */
    public function setSaleStartDate($saleStartDate)
    {
        $this->sale_start_date = $saleStartDate;

        return $this;
    }

    /**
     * Get sale_start_date
     *
     * @return \DateTime 
     */
    public function getSaleStartDate()
    {
        return $this->sale_start_date;
    }

    /**
     * Set sale_end_date
     *
     * @param \DateTime $saleEndDate
     * @return Adverts
     */
    public function setSaleEndDate($saleEndDate)
    {
        $this->sale_end_date = $saleEndDate;

        return $this;
    }

    /**
     * Get sale_end_date
     *
     * @return \DateTime 
     */
    public function getSaleEndDate()
    {
        return $this->sale_end_date;
    }

    /**
     * Set published
     *
     * @param integer $published
     * @return Adverts
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
     * Set featured
     *
     * @param integer $featured
     * @return Adverts
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;

        return $this;
    }

    /**
     * Get featured
     *
     * @return integer 
     */
    public function getFeatured()
    {
        return $this->featured;
    }

    /**
     * Set hit
     *
     * @param integer $hit
     * @return Adverts
     */
    public function setHit($hit)
    {
        $this->hit = $hit;

        return $this;
    }

    /**
     * Get hit
     *
     * @return integer 
     */
    public function getHit()
    {
        return $this->hit;
    }

    /**
     * Set latitude
     *
     * @param integer $latitude
     * @return Adverts
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return integer 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return Adverts
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set business_name
     *
     * @param string $businessName
     * @return Adverts
     */
    public function setBusinessName($businessName)
    {
        $this->business_name = $businessName;

        return $this;
    }

    /**
     * Get business_name
     *
     * @return string 
     */
    public function getBusinessName()
    {
        return $this->business_name;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return Adverts
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Adverts
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Adverts
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set payment_amount
     *
     * @param integer $paymentAmount
     * @return Adverts
     */
    public function setPaymentAmount($paymentAmount)
    {
        $this->payment_amount = $paymentAmount;

        return $this;
    }

    /**
     * Get payment_amount
     *
     * @return integer 
     */
    public function getPaymentAmount()
    {
        return $this->payment_amount;
    }

    /**
     * Set payment_status
     *
     * @param integer $paymentStatus
     * @return Adverts
     */
    public function setPaymentStatus($paymentStatus)
    {
        $this->payment_status = $paymentStatus;

        return $this;
    }

    /**
     * Get payment_status
     *
     * @return integer 
     */
    public function getPaymentStatus()
    {
        return $this->payment_status;
    }

    /**
     * Set payment_stage
     *
     * @param string $paymentStage
     * @return Adverts
     */
    public function setPaymentStage($paymentStage)
    {
        $this->payment_stage = $paymentStage;

        return $this;
    }

    /**
     * Get payment_stage
     *
     * @return string 
     */
    public function getPaymentStage()
    {
        return $this->payment_stage;
    }

    /**
     * Set payment_expiry
     *
     * @param \DateTime $paymentExpiry
     * @return Adverts
     */
    public function setPaymentExpiry($paymentExpiry)
    {
        $this->payment_expiry = $paymentExpiry;

        return $this;
    }

    /**
     * Get payment_expiry
     *
     * @return \DateTime 
     */
    public function getPaymentExpiry()
    {
        return $this->payment_expiry;
    }

    /**
     * Set payment_date
     *
     * @param \DateTime $paymentDate
     * @return Adverts
     */
    public function setPaymentDate($paymentDate)
    {
        $this->payment_date = $paymentDate;

        return $this;
    }

    /**
     * Get payment_date
     *
     * @return \DateTime 
     */
    public function getPaymentDate()
    {
        return $this->payment_date;
    }

    /**
     * Set business_logo
     *
     * @param string $businessLogo
     * @return Adverts
     */
    public function setBusinessLogo($businessLogo)
    {
        $this->business_logo = $businessLogo;

        return $this;
    }

    /**
     * Get business_logo
     *
     * @return string 
     */
    public function getBusinessLogo()
    {
        return $this->business_logo;
    }

    /**
     * Set package_id
     *
     * @param integer $packageId
     * @return Adverts
     */
    public function setPackageId($packageId)
    {
        $this->package_id = $packageId;

        return $this;
    }

    /**
     * Get package_id
     *
     * @return integer 
     */
    public function getPackageId()
    {
        return $this->package_id;
    }

    /**
     * Set package_price_id
     *
     * @param integer $packagePriceId
     * @return Adverts
     */
    public function setPackagePriceId($packagePriceId)
    {
        $this->package_price_id = $packagePriceId;

        return $this;
    }

    /**
     * Get package_price_id
     *
     * @return integer 
     */
    public function getPackagePriceId()
    {
        return $this->package_price_id;
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
