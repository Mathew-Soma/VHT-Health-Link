<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Tuberculosis;

class TuberculosisController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Tuberculosis';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Tuberculosis());

        $grid->column('id', __('Id'));
        $grid->column('Name', __('Name'));
        $grid->column('Phone', __('Phone'));
        $grid->column('TB_Status', __('TB Status'));
        $grid->column('PatientID', __('PatientID'));
        $grid->column('District', __('District'));
        $grid->column('SubCounty', __('SubCounty'));
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
        $show = new Show(Tuberculosis::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('Name', __('Name'));
        $show->field('Phone', __('Phone'));
        $show->field('TB_Status', __('TB Status'));
        $show->field('PatientID', __('PatientID'));
        $show->field('District', __('District'));
        $show->field('SubCounty', __('SubCounty'));
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
        $form = new Form(new Tuberculosis());

        $form->text('Name', __('Name'))->required()->placeholder('Name')->autofocus();
        $form->text('Phone', __('Phone'))->required()->placeholder('eg. +256 785 847252');
        $form->radio('TB_Status','TB_Status')->options(['Active' => 'Active', 'Latent' => 'Latent'])->default('Active')->required();
        $form->text('PatientID', __('PatientID'))->required();
        $form->text('District', __('District'))->required()->placeholder('District');
        $form->text('Subcounty', __('Subcounty'))->required()->placeholder('Sub county');
        $form->text('Village', __('Village'))->required()->placeholder('village');
        $form->date('Last_Hospital_Visit', __('Last Hospital Visit'))->required()->placeholder('Date of visit');

        return $form;
    }
}
