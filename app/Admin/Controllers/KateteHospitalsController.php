<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\KateteHospitals;

class KateteHospitalsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'KateteHospitals';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new KateteHospitals());

        $grid->column('id', __('Id'));
        $grid->column('Hospital_Name', __('Hospital Name'));
        $grid->column('No_of_Vhts', __('No of Vhts'));
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
        $show = new Show(KateteHospitals::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('Hospital_Name', __('Hospital Name'));
        $show->field('No_of_Vhts', __('No of Vhts'));
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
        $form = new Form(new KateteHospitals());

        $form->text('Hospital_Name', __('Hospital Name'));
        $form->text('No_of_Vhts', __('No of Vhts'));
        $form->text('Health_Inspector', __('Health Inspector'));

        return $form;
    }
}
