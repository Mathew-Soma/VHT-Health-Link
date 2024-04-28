<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\sessions;

class sessionsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'sessions';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new sessions());

        $grid->column('id', __('Id'));
        $grid->column('Date', __('Date'));
        $grid->column('Phone', __('Phone'));
        $grid->column('Duration', __('Duration'));
        $grid->column('SessionID', __('SessionID'));
        $grid->column('ServiceCode', __('ServiceCode'));
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
        $show = new Show(sessions::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('Date', __('Date'));
        $show->field('Phone', __('Phone'));
        $show->field('Duration', __('Duration'));
        $show->field('SessionID', __('SessionID'));
        $show->field('ServiceCode', __('ServiceCode'));
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
        $form = new Form(new sessions());

        $form->text('Date', __('Date'));
        $form->phonenumber('Phone', __('Phone'));
        $form->text('Duration', __('Duration'));
        $form->text('SessionID', __('SessionID'));
        $form->text('ServiceCode', __('ServiceCode'));

        return $form;
    }
}
