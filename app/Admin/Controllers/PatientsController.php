<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Patients;

class PatientsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Patients';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Patients());

        $grid->column('id', __('Id'));
        $grid->column('Name', __('Name'));
        $grid->column('Patient_Number', __('Patient Number'));
        $grid->column('Phone', __('Phone'));
        $grid->column('DOB', __('DOB'));
        $grid->column('District', __('District'));
        $grid->column('SubCounty', __('SubCounty'));
        $grid->column('Parish', __('Parish'));
        $grid->column('Village', __('Village'));
        $grid->column('Condition', __('Condition'));
        $grid->column('Current_State', __('Current State'));
        $grid->column('Health_Facility', __('Health Facility'));
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
        $show = new Show(Patients::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('Name', __('Name'));
        $show->field('Patient_Number', __('Patient Number'));
        $show->field('Phone', __('Phone'));
        $show->field('DOB', __('DOB'));
        $show->field('District', __('District'));
        $show->field('SubCounty', __('SubCounty'));
        $show->field('Parish', __('Parish'));
        $show->field('Village', __('Village'));
        $show->field('Condition', __('Condition'));
        $show->field('Current_State', __('Current State'));
        $show->field('Health_Facility', __('Health Facility'));
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
        $form = new Form(new Patients());

        $form->text('Name', __('Name'));
        $form->text('Patient_Number', __('Patient Number'));
        $form->phonenumber('Phone', __('Phone'));
        $form->text('DOB', __('DOB'));
        $form->text('District', __('District'));
        $form->text('SubCounty', __('SubCounty'));
        $form->text('Parish', __('Parish'));
        $form->text('Village', __('Village'));
        $form->text('Condition', __('Condition'));
        $form->text('Current_State', __('Current State'));
        $form->text('Health_Facility', __('Health Facility'));

        return $form;
    }
}
