<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Disease_Cases;

class Disease_CasesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Disease_Cases';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Disease_Cases());

        $grid->column('id', __('Id'));
        $grid->column('Case', __('Case'));
        $grid->column('Date', __('Date'));
        $grid->column('Number', __('Number'));
        $grid->column('District', __('District'));
        $grid->column('Subcounty', __('Subcounty'));
        $grid->column('Parish', __('Parish'));
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
        $show = new Show(Disease_Cases::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('Case', __('Case'));
        $show->field('Date', __('Date'));
        $show->field('Number', __('Number'));
        $show->field('District', __('District'));
        $show->field('Subcounty', __('Subcounty'));
        $show->field('Parish', __('Parish'));
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
        $form = new Form(new Disease_Cases());

        $form->text('Case', __('Case'));
        $form->date('Date', __('Date'))->default(date('Y-m-d'));
        $form->text('Number', __('Number'));
        $form->text('District', __('District'));
        $form->text('Subcounty', __('Subcounty'));
        $form->text('Parish', __('Parish'));
        $form->text('Village', __('Village'));
        $form->text('Risk', __('Risk'));

        return $form;
    }
}
