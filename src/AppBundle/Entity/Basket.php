<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Basket
 *
 * @ORM\Table(name="basket")
 * @ORM\Entity
 */
class Basket
{
    /**
     * @var integer
     * @ORM\Column(name="id_product", type="integer", nullable=false)
     */
    private $idProduct;

    /**
     * @var string
     *
     * @ORM\Column(name="id_session", type="string", nullable=false)
     */
    private $idSession;

    /**
     * @var integer
     *
     * @ORM\Column(name="count", type="integer", nullable=false)
     */
    private $count;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set idProduct
     *
     * @param integer $idProduct
     *
     * @return Basket
     */
    public function setIdProduct($idProduct)
    {
        $this->idProduct = $idProduct;

        return $this;
    }

    /**
     * Get idProduct
     *
     * @return integer
     */
    public function getIdProduct()
    {
        return $this->idProduct;
    }

    /**
     * Set idSession
     *
     * @param string $idSession
     *
     * @return Basket
     */
    public function setIdSession($idSession)
    {
        $this->idSession = $idSession;

        return $this;
    }

    /**
     * Get idSession
     *
     * @return string
     */
    public function getIdSession()
    {
        return $this->idSession;
    }

    /**
     * Set count
     *
     * @param integer $count
     *
     * @return Basket
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    public function updateCount()
    {
        $this->count = $this->getCount()+1;

        return $this;
    }

    public function minusCount()
    {
        $this->count = $this->getCount()-1;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function createPosition()
    {
        $position = new Positions();
        $position->setCount($this->getCount());
        $position->setIdProduct($this->getIdProduct());

        return $position;
    }
}
