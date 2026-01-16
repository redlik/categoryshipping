<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

include_once(_PS_MODULE_DIR_ . 'categoryshipping/classes/ShippingClass.php');

class CategoryShipping extends Module
{

    public $tabs = [
        [
            'name' => 'Shipping Classes', // Menu label
            'class_name' => 'AdminCategoryShipping', // Controller name without 'Controller'
            'visible' => true,
            'parent_class_name' => 'AdminParentShipping', // Where to place it (e.g., under Customers)
        ],
    ];
    public function __construct()
    {
        $this->name = 'categoryshipping';
        $this->tab = 'shipping_logistics';
        $this->version = '1.0.0';
        $this->author = 'Rafco';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = ['min' => '8.0', 'max' => _PS_VERSION_];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->trans('Category Shipping', [], 'Modules.Categoryshipping.Admin');
        $this->description = $this->trans('Allows you to set shipping costs for categories.', [], 'Modules.Categoryshipping.Admin');
    }

    public function install()
    {
        return parent::install() && $this->createShippingTable();
    }

    public function uninstall()
    {
        return parent::uninstall() && $this->deleteTable();
    }

    public function createShippingTable()
    {
        /* Adding extra column for shipping rate */
        Db::getInstance()->execute('ALTER TABLE `' . _DB_PREFIX_ . 'category` ADD `id_my_shipping_rate` INT(11) UNSIGNED DEFAULT 0');

        $query = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'category_shipping` (
        `id_data` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `machine_name` varchar(255) NOT NULL,
        `rate` int(11) NOT NULL,
        `date_add` datetime NOT NULL,
        PRIMARY KEY (`id_data`)
        ) ENGINE='. _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

        return Db::getInstance()->execute($query);
    }

    public function deleteTable()
    {
        DB::getInstance()->execute('ALTER TABLE `' . _DB_PREFIX_ . 'category` DROP COLUMN `id_my_shipping_rate`');

        $query = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'category_shipping`';
        return Db::getInstance()->execute($query);
    }

    public function getContent()
    {
        $output = '';

        if (Tools::isSubmit('submitCategoryShipping')) {
            $id_data = (int) Tools::getValue('id_data');
        }
    }


}
