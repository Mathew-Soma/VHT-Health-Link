<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\aidspatients;

class aidspatientsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'aidspatients';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new aidspatients());

        $grid->column('id', __('Id'));
        $grid->column('Name', __('Name'));
        $grid->column('Phone', __('Phone'));
        $grid->column('Gender', __('Gender'));
        $grid->column('DOB', __('DOB'));
        $grid->column('Last_Visit', __('Last Visit'));
        $grid->column('PatientID', __('PatientID'));
        $grid->column('District', __('District'));
        $grid->column('Subcounty', __('Subcounty'));
        $grid->column('Village', __('Village'));
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
        $show = new Show(aidspatients::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('Name', __('Name'));
        $show->field('Phone', __('Phone'));
        $show->field('Gender', __('Gender'));
        $show->field('DOB', __('DOB'));
        $show->field('Last_Visit', __('Last Visit'));
        $show->field('PatientID', __('PatientID'));
        $show->field('District', __('District'));
        $show->field('Subcounty', __('Subcounty'));
        $show->field('Village', __('Village'));
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
        $form = new Form(new aidspatients());

        $form->text('Name', __('Name'))->required()->placeholder('Name')->autofocus();
        $form->text('Phone', __('Phone'))->required()->placeholder('eg. +256 785 847252')->help('start with +256...');
        //$form->text('Gender', __('Gender'))->required();
        $form->radio('Gender','Gender')->options(['M' => 'Male', 'F' => 'Female'])->default('M')->required();
        $form->date('DOB', __('DOB'))->required()->placeholder('Date of birth');
        $form->date('Last_Visit', __('Last Visit'))->required()->placeholder('Date of visit');
        // Generate a random number for PatientID
        $randomPatientID = mt_rand(10000, 99999); // Adjust the range as needed
        $form->text('PatientID', __('PatientID'))->required()->placeholder('Patient ID')->value($randomPatientID)->readonly();
    
        $form->text('District', __('District'))->required()->placeholder('District');
        $form->text('Subcounty', __('Subcounty'))->required()->placeholder('Subcounty');
        $form->text('Village', __('Village'))->required()->placeholder('Village');

        return $form;
    }
}
