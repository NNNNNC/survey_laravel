<?php
namespace App\Admin\Controllers;

use App\Models\Office;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;

class OfficesController extends AdminController
{
    protected function grid()
    {
        $grid = new Grid(new Office());

        $grid->column('id', 'ID')->sortable();
        $grid->column('name', 'Office Name')->sortable();

        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Office());

        $form->text('name', 'Office Name')->required();

        return $form;
    }
}
