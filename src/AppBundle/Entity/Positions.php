<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Positions
 *
 * @ORM\Table(name="positions", indexes={@ORM\Index(name="Id_product", columns={"id_product"}), @ORM\Index(name="id_order", columns={"id_order"})})
 * @ORM\Entity
 */
class Positions
{


    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity = "Products")
     * @ORM\JoinColumn(name="id_product", referencedColumnName="id")
     */
    private $product;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Orders", inversedBy="position")
     * @ORM\JoinColumn(name="id_order", referencedColumnName="id")
     */
    private $order = 0;

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
     * @var integer
     * @ORM\Column(name="cost", type="integer")
     */
    private $cost;



    /**
     * Set product
     *
     * @param \AppBundle\Entity\Products $product
     *
     * @return Positions
     */
    public function setProduct(Products $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return integer
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set Order
     *
     * @param \AppBundle\Entity\Orders $order
     *
     * @return Positions
     */
    public function setOrder(Orders $order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set count
     *
     * @param integer $count
     *
     * @return Positions
     */
    public function setCount($count)
    {
        $this->count = $count;

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

    /**
     * Set cost
     *
     * @param integer $cost
     *
     * @return Positions
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return integer
     */
    public function getCost()
    {
        return $this->cost;
    }
}
