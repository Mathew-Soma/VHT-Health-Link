<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\expectantmothers;

class expectantmothersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'expectantmothers';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new expectantmothers());

        $grid->column('id', __('Id'));
        $grid->column('Name', __('Name'));
        $grid->column('Phone', __('Phone'));
        $grid->column('PatientID', __('PatientID'));
        $grid->column('Antenantal_care_visits', __('Antenantal care visits'));
        $grid->column('DOB', __('DOB'));
        $grid->column('Complications', __('Complications'));
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
        $show = new Show(expectantmothers::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('Name', __('Name'));
        $show->field('Phone', __('Phone'));
        $show->field('PatientID', __('PatientID'));
        $show->field('Antenantal_care_visits', __('Antenantal care visits'));
        $show->field('DOB', __('DOB'));
        $show->field('Complications', __('Complications'));
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
        $form = new Form(new expectantmothers());

        $form->text('Name', __('Name'))->required()->placeholder('Name')->autofocus();
        $form->text('Phone', __('Phone'))->required()->placeholder('eg. +256 785 847252');
        $form->text('PatientID', __('PatientID'))->required();
        $form->date('Antenantal_care_visits', __('Antenantal care visits'))->required()->placeholder('Date of visit');
        $form->date('DOB', __('DOB'))->required()->placeholder('Date of birth');
        $form->text('Complications', __('Complications'))->placeholder('Complications');
        $form->text('District', __('District'))->required()->placeholder('District');
        $form->text('Subcounty', __('Subcounty'))->required()->placeholder('Sub county');
        $form->text('Village', __('Village'))->required()->placeholder('village');


        return $form;
    }
}
