<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\ReportedCases;

class ReportedCasesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ReportedCases';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ReportedCases());

        $grid->column('id', __('Id'));
        $grid->column('DiseaseName', __('DiseaseName'));
        $grid->column('Phone', __('Phone'));
        $grid->column('Number_of_Patients', __('Number of Patients'));
        $grid->column('VHT_Name', __('VHT Name'));
        $grid->column('Date', __('Date'));
        $grid->column('District', __('District'));
        $grid->column('Subcounty', __('Subcounty'));
        //$grid->column('Parish', __('Parish'));
        $grid->column('Village', __('Village'));
        $grid->column('Risk', __('Risk'));
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
        $show = new Show(ReportedCases::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('DiseaseName', __('DiseaseName'));
        $show->field('Phone', __('Phone'));
        $show->field('Number_of_Patients', __('Number of Patients'));
        $show->field('VHT_Name', __('VHT Name'));
        $show->field('Date', __('Date'));
        $show->field('District', __('District'));
        $show->field('Subcounty', __('Subcounty'));
        //$show->field('Parish', __('Parish'));
        $show->field('Village', __('Village'));
        $show->field('Risk', __('Risk'));
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
        $form = new Form(new ReportedCases());

        $form->text('DiseaseName', __('DiseaseName'));
        $form->phonenumber('Phone', __('Phone'));
        $form->text('Number_of_Patients', __('Number of Patients'));
        $form->text('VHT_Name', __('VHT Name'));
        $form->text('Date', __('Date'));
        $form->text('District', __('District'));
        $form->text('Subcounty', __('Subcounty'));
        //$form->text('Parish', __('Parish'));
        $form->text('Village', __('Village'));
        $form->text('Risk', __('Risk'));

        return $form;
    }
}
