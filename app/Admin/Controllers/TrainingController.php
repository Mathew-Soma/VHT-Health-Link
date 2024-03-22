<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Training;

class TrainingController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Training';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Training());

        $grid->column('id', __('Id'));
        $grid->column('Topic', __('Topic'));
        $grid->column('Trainer', __('Trainer'));
        $grid->column('Date', __('Date'));
        $grid->column('Period', __('Period'));
        $grid->column('Venue', __('Venue'));
        $grid->column('Time', __('Time'));
        $grid->column('Status', __('Status'));
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
        $show = new Show(Training::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('Topic', __('Topic'));
        $show->field('Trainer', __('Trainer'));
        $show->field('Date', __('Date'));
        $show->field('Period', __('Period'));
        $show->field('Venue', __('Venue'));
        $show->field('Time', __('Time'));
        $show->field('Status', __('Status'));
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
        $form = new Form(new Training());

        $form->text('Topic', __('Topic'));
        $form->text('Trainer', __('Trainer'));
        $form->date('Date', __('Date'))->default(date('Y-m-d'));
        $form->text('Period', __('Period'));
        $form->text('Venue', __('Venue'));
        $form->time('Time', __('Time'))->default(date('H:i:s'));
        $form->text('Status', __('Status'));

        return $form;
    }
}
