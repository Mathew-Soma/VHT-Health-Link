<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\BomaHospitals;

class BomaHospitalsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'BomaHospitals';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BomaHospitals());

        $grid->column('id', __('Id'));
        $grid->column('HospitalName', __('HospitalName'));
        $grid->column('Number_of_Vhts', __('Number of Vhts'));
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
        $show = new Show(BomaHospitals::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('HospitalName', __('HospitalName'));
        $show->field('Number_of_Vhts', __('Number of Vhts'));
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
        $form = new Form(new BomaHospitals());

        $form->text('HospitalName', __('HospitalName'));
        $form->text('Number_of_Vhts', __('Number of Vhts'));
        $form->text('Health_Inspector', __('Health Inspector'));

        return $form;
    }
}
