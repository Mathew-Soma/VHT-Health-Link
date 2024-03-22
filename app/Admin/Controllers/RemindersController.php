<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Reminders;

class RemindersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Reminders';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Reminders());

        $grid->column('id', __('Id'));
        $grid->column('Reciepient', __('Reciepient'));
        $grid->column('Message', __('Message'));
        $grid->column('DeliveryStatus', __('DeliveryStatus'));
        $grid->column('Time', __('Time'));
        $grid->column('Date', __('Date'));
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
        $show = new Show(Reminders::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('Reciepient', __('Reciepient'));
        $show->field('Message', __('Message'));
        $show->field('DeliveryStatus', __('DeliveryStatus'));
        $show->field('Time', __('Time'));
        $show->field('Date', __('Date'));
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
        $form = new Form(new Reminders());

        $form->text('Reciepient', __('Reciepient'));
        $form->text('Message', __('Message'));
        $form->text('DeliveryStatus', __('DeliveryStatus'));
        $form->time('Time', __('Time'))->default(date('H:i:s'));
        $form->date('Date', __('Date'))->default(date('Y-m-d'));

        return $form;
    }
}
