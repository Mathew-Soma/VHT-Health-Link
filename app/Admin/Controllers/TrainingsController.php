<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Trainings;

class TrainingsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Trainings';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Trainings());

        $grid->column('id', __('Id'));
        $grid->column('Date', __('Date'));
        $grid->column('Type', __('Type'));
        $grid->column('Venue', __('Venue'));
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
        $show = new Show(Trainings::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('Date', __('Date'));
        $show->field('Type', __('Type'));
        $show->field('Venue', __('Venue'));
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
        $form = new Form(new Trainings());

        $form->text('Date', __('Date'));
        $form->text('Type', __('Type'));
        $form->text('Venue', __('Venue'));

        return $form;
    }
}
