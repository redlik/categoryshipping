<?php

class AdminCategoryShippingController extends ModuleAdminController
{
    public function __construct()
    {
        $this->bootstrap = true; // Use Bootstrap styling
        $this->table = 'category_shipping'; // Your database table (without prefix)
        $this->className = 'ShippingClass'; // The ObjectModel class name
        $this->identifier = 'id_data'; // The primary key
        $this->lang = false; // Set true if your table has a _lang version

        parent::__construct();

        // Define the columns for the list
        $this->fields_list = [
            'id_data' => [
                'title' => 'ID',
                'align' => 'center',
                'class' => 'fixed-width-xs',
            ],
            'name' => [
                'title' => 'Name',
                'filter_key' => 'a!name',
            ],
            'rate' => [
                'title' => 'Rate',
                'type' => 'number',
                'prefix' => '€'
            ],
        ];

        // Enable Edit and Delete actions in the list
        $this->addRowAction('edit');
        $this->addRowAction('delete');
    }

    // This renders the form when you click "Add New" or "Edit"
    public function renderForm()
    {
        $this->fields_form = [
            'legend' => [
                'title' => 'Manage Shipping Classes',
                'icon' => 'icon-list-ul',
            ],
            'input' => [
                [
                    'type' => 'text',
                    'label' => 'Name',
                    'name' => 'name',
                    'required' => true,
                ],
                [
                    'type' => 'text',
                    'label' => 'Rate',
                    'name' => 'rate',
                    'prefix' => '€',
                    'required' => true,
                    'desc' => 'Add a rate in euro. Decimals are allowed. Example: 10.99',
                    'cast' => 'floatval',
                ],
            ],
            'submit' => [
                'title' => 'Save',
            ],
        ];

        return parent::renderForm();
    }
}
