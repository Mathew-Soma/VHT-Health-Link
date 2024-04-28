<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\aids;

class aidsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'aids';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new aids());

        $grid->column('id', __('Id'));
        $grid->column('Name', __('Name'));
        $grid->column('Phone', __('Phone'));
        $grid->column('Gender', __('Gender'));
        $grid->column('DOB', __('DOB'));
        $grid->column('Last_Visit', __('Last Visit'));
        $grid->column('PatientID', __('PatientID'));
        $grid->column('District', __('District'));
        $grid->column('Village', __('Village'));
        $grid->column('Subcounty', __('Subcounty'));
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
        $show = new Show(aids::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('Name', __('Name'));
        $show->field('Phone', __('Phone'));
        $show->field('Gender', __('Gender'));
        $show->field('DOB', __('DOB'));
        $show->field('Last_Visit', __('Last Visit'));
        $show->field('PatientID', __('PatientID'));
        $show->field('District', __('District'));
        $show->field('Village', __('Village'));
        $show->field('Subcounty', __('Subcounty'));
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
        $form = new Form(new aids());

        $form->text('Name', __('Name'));
        $form->phonenumber('Phone', __('Phone'));
        $form->text('Gender', __('Gender'));
        $form->date('DOB', __('DOB'))->default(date('Y-m-d'));
        $form->text('Last_Visit', __('Last Visit'));
        $form->text('PatientID', __('PatientID'));
        $form->text('District', __('District'));
        $form->text('Village', __('Village'));
        $form->text('Subcounty', __('Subcounty'));

        return $form;
    }
}
