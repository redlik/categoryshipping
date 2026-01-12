<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class CategoryShipping extends Module
{
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
        return parent::install() && $this->registerHook('displayHome');
    }

    public function uninstall()
    {
        return parent::uninstall();
    }

    public function hookDisplayHome($params)
    {
        return "This is my freaking module!";
    }
}
