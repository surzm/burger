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
     *
     * @ORM\Column(name="id_product", type="integer", nullable=false)
     */
    private $idProduct;

    /**
     * @var integer
     *  /**
     * @ORM\ManyToOne(targetEntity="Positions", inversedBy="position")
     * @ORM\JoinColumn(name="id_order", referencedColumnName="id")
     * @ORM\Column(name="id_order", type="integer", nullable=true)
     */
    private $idOrder = 0;

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
     * @return Positions
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
     * Set idOrder
     *
     * @param integer $idOrder
     *
     * @return Positions
     */
    public function setIdOrder($idOrder)
    {
        $this->idOrder = $idOrder;

        return $this;
    }

    /**
     * Get idOrder
     *
     * @return integer
     */
    public function getIdOrder()
    {
        return $this->idOrder;
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
}
