<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\kideraa;

class kideraaController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'kideraa';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new kideraa());

        $grid->column('id', __('Id'));
        $grid->column('VHT_Name', __('VHT Name'));
        $grid->column('Phone', __('Phone'));
        $grid->column('Gender', __('Gender'));
        $grid->column('DOB', __('DOB'));
        $grid->column('Health_Facility_Attached', __('Health Facility Attached'));
        $grid->column('Level_of_education', __('Level of education'));
        $grid->column('district', __('District'));
        $grid->column('subcounty', __('Subcounty'));
        $grid->column('village', __('Village'));
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
        $show = new Show(kideraa::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('VHT_Name', __('VHT Name'));
        $show->field('Phone', __('Phone'));
        $show->field('Gender', __('Gender'));
        $show->field('DOB', __('DOB'));
        $show->field('Health_Facility_Attached', __('Health Facility Attached'));
        $show->field('Level_of_education', __('Level of education'));
        $show->field('district', __('District'));
        $show->field('subcounty', __('Subcounty'));
        $show->field('village', __('Village'));
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
        $form = new Form(new kideraa());

        $form->text('VHT_Name', __('VHT Name'));
        $form->text('Phone', __('Phone'));
        $form->text('Gender', __('Gender'));
        $form->date('DOB', __('DOB'))->default(date('Y-m-d'));
        $form->text('Health_Facility_Attached', __('Health Facility Attached'));
        $form->text('Level_of_education', __('Level of education'));
        $form->text('district', __('District'));
        $form->text('subcounty', __('Subcounty'));
        $form->text('village', __('Village'));

        return $form;
    }
}
