<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\HealthCenters;

class HealthCentersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'HealthCenters';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new HealthCenters());

        $grid->column('id', __('Id'));
        $grid->column('Name', __('Name'));
        $grid->column('District', __('District'));
        $grid->column('Subcounty', __('Subcounty'));
        $grid->column('Parish', __('Parish'));
        $grid->column('Village', __('Village'));
        $grid->column('Number_of_healthworkers', __('Number of healthworkers'));
        $grid->column('Number_of_vhts', __('Number of vhts'));
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
        $show = new Show(HealthCenters::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('Name', __('Name'));
        $show->field('District', __('District'));
        $show->field('Subcounty', __('Subcounty'));
        $show->field('Parish', __('Parish'));
        $show->field('Village', __('Village'));
        $show->field('Number_of_healthworkers', __('Number of healthworkers'));
        $show->field('Number_of_vhts', __('Number of vhts'));
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
        $form = new Form(new HealthCenters());

        $form->text('Name', __('Name'));
        $form->text('District', __('District'));
        $form->text('Subcounty', __('Subcounty'));
        $form->text('Parish', __('Parish'));
        $form->text('Village', __('Village'));
        $form->text('Number_of_healthworkers', __('Number of healthworkers'));
        $form->text('Number_of_vhts', __('Number of vhts'));

        return $form;
    }
}
