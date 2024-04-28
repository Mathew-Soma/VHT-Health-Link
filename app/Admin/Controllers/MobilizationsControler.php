<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Mobilizations;

class MobilizationsControler extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Mobilizations';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Mobilizations());

        $grid->column('id', __('Id'));
        $grid->column('Activity', __('Activity'));
        $grid->column('Date', __('Date'));
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
        $show = new Show(Mobilizations::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('Activity', __('Activity'));
        $show->field('Date', __('Date'));
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
        $form = new Form(new Mobilizations());

        $form->text('Activity', __('Activity'));
        $form->text('Date', __('Date'));
        $form->text('Venue', __('Venue'));

        return $form;
    }
}
