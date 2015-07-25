<?php

namespace Xst\Models;

use \Phalcon\Mvc\Model;

class Products extends Model {

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var integer
     */
    protected $product_types_id;

    /**
     *
     * @var string
     */
    protected $name;

    /**
     *
     * @var double
     */
    protected $price;

    /**
     *
     * @var string
     */
    protected $active;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id) {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field product_types_id
     *
     * @param integer $product_types_id
     * @return $this
     */
    public function setProductTypesId($product_types_id) {
        $this->product_types_id = $product_types_id;

        return $this;
    }

    /**
     * Method to set the value of field name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Method to set the value of field price
     *
     * @param double $price
     * @return $this
     */
    public function setPrice($price) {
        $this->price = $price;

        return $this;
    }

    /**
     * Method to set the value of field active
     *
     * @param string $active
     * @return $this
     */
    public function setActive($active) {
        $this->active = $active;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field product_types_id
     *
     * @return integer
     */
    public function getProductTypesId() {
        return $this->product_types_id;
    }

    /**
     * Returns the value of field name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Returns the value of field price
     *
     * @return double
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * Returns the value of field active
     *
     * @return string
     */
    public function getActive() {
        return $this->active;
    }
}
