<?php

class Listing extends Model
{
    protected $id;
    protected $creation_date;
    protected $title;
    protected $description;
    protected $duration;
    protected $price;
    protected $end_date;
    protected $sale_date;
    protected $id_member;
    protected $id_buyer;

    public function __construct($id, $creation_date, $title, $description, $duration, $price, $end_date, $sale_date, $id_member, $id_buyer)
    {
        $this->id = $id;
        $this->creation_date = $creation_date;
        $this->title = $title;
        $this->description = $description;
        $this->duration = $duration;
        $this->price = $price;
        $this->end_date = $end_date;
        $this->sale_date = $sale_date;
        $this->id_member = $id_member;
        $this->id_buyer = $id_buyer;
    }
        
    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getCreation_date()
    {
        return $this->creation_date;
    }

    public function setCreation_date($creation_date): void
    {
        $this->creation_date = $creation_date;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($duration): void
    {
        $this->duration = $duration;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): void
    {
        $this->price = $price;
    }

    public function getEnd_date()
    {
        return $this->end_date;
    }

    public function setEnd_date($end_date): void
    {
        $this->end_date = $end_date;
    }

    public function getSale_date()
    {
        return $this->sale_date;
    }

    public function setSale_date($sale_date): void
    {
        $this->sale_date = $sale_date;
    }

    public function getId_member()
    {
        return $this->id_member;
    }

    public function setId_member($id_member): void
    {
        $this->id_member = $id_member;
    }

    public function getId_buyer()
    {
        return $this->id_buyer;
    }

    public function setId_buyer($id_buyer): void
    {
        $this->id_buyer = $id_buyer;
    }

}

?>