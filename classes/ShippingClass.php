<?php

class ShippingClass extends ObjectModel
{
    public $id_data;
    public $name;
    public $machine_name;
    public $rate;
    public $date_add;

    // Define how this class maps to the database
    public static $definition = [
        'table' => 'category_shipping',
        'primary' => 'id_data',
        'fields' => [
            'name'   => ['type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'required' => true, 'size' => 255],
            'machine_name' => ['type' => self::TYPE_STRING, 'validate' => 'isLinkRewrite', 'copy_post' => false],
            'rate' => ['type' => self::TYPE_INT, 'validate' => 'isInt'],
            'date_add'   => ['type' => self::TYPE_DATE, 'validate' => 'isDate', 'copy_post' => false],
        ],
    ];

    public function add($autodate = true, $null_values = false) {
        if (empty($this->machine_name)) {
            $this->machine_name = Tools::str2url($this->name);
        }

        return parent::add($autodate, $null_values);
    }

    public function update($autodate = true, $null_values = false)
    {
        $this->machine_name = Tools::str2url($this->name);

        return parent::update($autodate, $null_values);
    }
}
