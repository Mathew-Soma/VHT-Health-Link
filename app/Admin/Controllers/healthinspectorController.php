<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\healthinspector;

class healthinspectorController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'healthinspector';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new healthinspector());

        $grid->column('id', __('Id'));
        $grid->column('Name', __('Name'));
        $grid->column('Phone', __('Phone'));
        $grid->column('Email', __('Email'));
        $grid->column('District', __('District'));
        $grid->column('Parish', __('Parish'));
        $grid->column('Village', __('Village'));
        $grid->column('DOB', __('DOB'));
        $grid->column('InspectorNumber', __('InspectorNumber'));
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
        $show = new Show(healthinspector::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('Name', __('Name'));
        $show->field('Phone', __('Phone'));
        $show->field('Email', __('Email'));
        $show->field('District', __('District'));
        $show->field('Parish', __('Parish'));
        $show->field('Village', __('Village'));
        $show->field('DOB', __('DOB'));
        $show->field('InspectorNumber', __('InspectorNumber'));
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
        $form = new Form(new healthinspector());

        $form->text('Name', __('Name'));
        $form->phonenumber('Phone', __('Phone'));
        $form->email('Email', __('Email'));
        $form->text('District', __('District'));
        $form->text('Parish', __('Parish'));
        $form->text('Village', __('Village'));
        $form->date('DOB', __('DOB'))->default(date('Y-m-d'));
        $form->text('InspectorNumber', __('InspectorNumber'));

        return $form;
    }
}
