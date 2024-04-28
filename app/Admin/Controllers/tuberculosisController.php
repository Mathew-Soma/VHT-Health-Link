<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\tuberculosis;

class tuberculosisController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'tuberculosis';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new tuberculosis());

        $grid->column('id', __('Id'));
        $grid->column('Name', __('Name'));
        $grid->column('Phone', __('Phone'));
        $grid->column('TB_Status', __('TB Status'));
        $grid->column('PatientID', __('PatientID'));
        $grid->column('District', __('District'));
        $grid->column('Subcounty', __('Subcounty'));
        $grid->column('Village', __('Village'));
        $grid->column('Last_Hospital_Visit', __('Last Hospital Visit'));
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
        $show = new Show(tuberculosis::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('Name', __('Name'));
        $show->field('Phone', __('Phone'));
        $show->field('TB_Status', __('TB Status'));
        $show->field('PatientID', __('PatientID'));
        $show->field('District', __('District'));
        $show->field('Subcounty', __('Subcounty'));
        $show->field('Village', __('Village'));
        $show->field('Last_Hospital_Visit', __('Last Hospital Visit'));
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
        $form = new Form(new tuberculosis());

        $form->text('Name', __('Name'));
        $form->phonenumber('Phone', __('Phone'));
        $form->text('TB_Status', __('TB Status'));
        $form->text('PatientID', __('PatientID'));
        $form->text('District', __('District'));
        $form->text('Subcounty', __('Subcounty'));
        $form->text('Village', __('Village'));
        $form->text('Last_Hospital_Visit', __('Last Hospital Visit'));

        return $form;
    }
}
