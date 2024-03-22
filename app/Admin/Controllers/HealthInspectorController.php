<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\HealthInspector;

class HealthInspectorController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'HealthInspector';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new HealthInspector());

        $grid->column('id', __('Id'));
        $grid->column('Name', __('Name'));
        $grid->column('Phone', __('Phone'));
        $grid->column('Email', __('Email'));
        $grid->column('District', __('District'));
        $grid->column('Parish', __('Parish'));
        $grid->column('Village', __('Village'));
        $grid->column('Bio', __('Bio'));
        $grid->column('HealthInspectorNumber', __('HealthInspectorNumber'));
        $grid->column('DOB', __('DOB'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(HealthInspector::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('Name', __('Name'));
        $show->field('Phone', __('Phone'));
        $show->field('Email', __('Email'));
        $show->field('District', __('District'));
        $show->field('Parish', __('Parish'));
        $show->field('Village', __('Village'));
        $show->field('Bio', __('Bio'));
        $show->field('HealthInspectorNumber', __('HealthInspectorNumber'));
        $show->field('DOB', __('DOB'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new HealthInspector());

        $form->text('Name', __('Name'));
        $form->phonenumber('Phone', __('Phone'));
        $form->email('Email', __('Email'));
        $form->text('District', __('District'));
        $form->text('Parish', __('Parish'));
        $form->text('Village', __('Village'));
        $form->text('Bio', __('Bio'));
        $form->text('HealthInspectorNumber', __('HealthInspectorNumber'));
        $form->date('DOB', __('DOB'))->default(date('Y-m-d'));

        return $form;
    }
}
