<?php
namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Survey;

class SurveyController extends AdminController
{
    protected function grid()
    {
        $grid = new Grid(new Survey());

        $grid->column('id', 'ID')->sortable();
        $grid->column('client_type', 'Client Type');
        $grid->column('date', 'Date');
        $grid->column('age', 'Age');
        $grid->column('sex', 'Sex');
        $grid->column('office_visited', 'Office Visited');
        $grid->column('service', 'Service');
        $grid->column('awareness', 'Awareness');
        $grid->column('visibility', 'Visibility');
        $grid->column('helpfulness', 'Helpfulness');
        $grid->column('service_satisfaction', 'Service Satisfaction');
        $grid->column('comments', 'Comments');

        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Survey());

        $form->text('client_type', 'Client Type')->required();
        $form->date('date', 'Date')->required();
        $form->number('age', 'Age')->min(1)->max(120);
        $form->select('sex', 'Sex')->options(['Male' => 'Male', 'Female' => 'Female']);
        $form->text('office_visited', 'Office Visited');
        $form->text('service', 'Service');
        $form->text('awareness', 'Awareness');
        $form->text('visibility', 'Visibility');
        $form->text('helpfulness', 'Helpfulness');
        $form->text('service_satisfaction', 'Service Satisfaction');
        $form->textarea('comments', 'Comments');

        return $form;
    }
}