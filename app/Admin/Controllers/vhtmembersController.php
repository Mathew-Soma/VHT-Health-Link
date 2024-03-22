<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\vhtmembers;

class vhtmembersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'vhtmembers';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new vhtmembers());

        $grid->column('id', __('Id'));
        $grid->column('Name', __('Name'));
        $grid->column('Phone', __('Phone'));
        $grid->column('Gender', __('Gender'));
        $grid->column('DOB', __('DOB'));
        $grid->column('District', __('District'));
        $grid->column('SubCounty', __('SubCounty'));
        $grid->column('Parish', __('Parish'));
        $grid->column('Village', __('Village'));
        $grid->column('Health_facility_attached', __('Health facility attached'));
        $grid->column('vhtnumber', __('Vhtnumber'));
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
        $show = new Show(vhtmembers::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('Name', __('Name'));
        $show->field('Phone', __('Phone'));
        $show->field('Gender', __('Gender'));
        $show->field('DOB', __('DOB'));
        $show->field('District', __('District'));
        $show->field('SubCounty', __('SubCounty'));
        $show->field('Parish', __('Parish'));
        $show->field('Village', __('Village'));
        $show->field('Health_facility_attached', __('Health facility attached'));
        $show->field('vhtnumber', __('Vhtnumber'));
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
        $form = new Form(new vhtmembers());

        $form->text('Name', __('Name'));
        $form->text('Phone', __('Phone'));
        $form->text('Gender', __('Gender'));
        $form->text('DOB', __('DOB'));
        $form->text('District', __('District'));
        $form->text('SubCounty', __('SubCounty'));
        $form->text('Parish', __('Parish'));
        $form->text('Village', __('Village'));
        $form->text('Health_facility_attached', __('Health facility attached'));
        $form->text('vhtnumber', __('Vhtnumber'));

        return $form;
    }
}
