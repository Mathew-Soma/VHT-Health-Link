<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Villages;

class VillagesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Villages';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Villages());

        $grid->column('id', __('Id'));
        $grid->column('Name', __('Name'));
        $grid->column('District', __('District'));
        $grid->column('Subcounty', __('Subcounty'));
        $grid->column('Parish', __('Parish'));
        $grid->column('Number_of_vhts', __('Number of vhts'));
        $grid->column('Health_facility_attached', __('Health facility attached'));
        $grid->column('Health_Inspector', __('Health Inspector'));
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
        $show = new Show(Villages::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('Name', __('Name'));
        $show->field('District', __('District'));
        $show->field('Subcounty', __('Subcounty'));
        $show->field('Parish', __('Parish'));
        $show->field('Number_of_vhts', __('Number of vhts'));
        $show->field('Health_facility_attached', __('Health facility attached'));
        $show->field('Health_Inspector', __('Health Inspector'));
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
        $form = new Form(new Villages());

        $form->text('Name', __('Name'));
        $form->text('District', __('District'));
        $form->text('Subcounty', __('Subcounty'));
        $form->text('Parish', __('Parish'));
        $form->text('Number_of_vhts', __('Number of vhts'));
        $form->text('Health_facility_attached', __('Health facility attached'));
        $form->text('Health_Inspector', __('Health Inspector'));

        return $form;
    }
}
