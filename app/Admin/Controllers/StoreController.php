<?php

namespace App\Admin\Controllers;

use App\Models\Store;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class StoreController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Store';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Store());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('category.name', __('Category Name'));
        $grid->column('name', __('Name'));
        $grid->column('image', __('Image'))->image();
        $grid->column('picture', __('Picture'));
        $grid->column('description', __('Description'));
        $grid->column('under_price', __('Under price'))->sortable();
        $grid->column('upper_price', __('Upper price'))->sortable();
        $grid->column('open_time', __('Open time'));
        $grid->column('closed_time', __('Closed time'));
        $grid->column('postal_code', __('Postal code'));
        $grid->column('address', __('Address'));
        $grid->column('phone', __('Phone'));
        $grid->column('closed_day', __('Closed day'));
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();

        $grid->filter(function($filter) {
            $filter->like('name', '店舗名');
            $filter->like('description', '店舗説明');
            $filter->between('under_price', '最低金額');
            $filter->between('upper_price', '最高金額');
            $filter->in('category_id', 'カテゴリー')->multipleSelect(Category::all()->pluck('name','id'));

        });


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
        $show = new Show(Store::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('category.name', __('Category Name'));
        $show->field('name', __('Name'));
        $show->field('image', __('Image'))->image();
        $show->field('picture', __('Picture'));
        $show->field('description', __('Description'));
        $show->field('under_price', __('Under price'));
        $show->field('upper_price', __('Upper price'));
        $show->field('open_time', __('Open time'));
        $show->field('closed_time', __('Closed time'));
        $show->field('postal_code', __('Postal code'));
        $show->field('address', __('Address'));
        $show->field('phone', __('Phone'));
        $show->field('closed_day', __('Closed day'));
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
        $form = new Form(new Store());

        $form->select('category_id', __('Category Name'))->options(Category::all()->pluck('name', 'id'));
        $form->text('name', __('Name'));
        $form->image('picture', __('Picture'));
        $form->textarea('description', __('Description'));
        $form->number('under_price', __('Under price'));
        $form->number('upper_price', __('Upper price'));
        $form->text('open_time', __('Open time'));
        $form->text('closed_time', __('Closed time'));
        $form->text('postal_code', __('Postal code'));
        $form->text('address', __('Address'));
        $form->mobile('phone', __('Phone'));
        $form->text('closed_day', __('Closed day'));
        $form->image('image', __('Image'));

        return $form;
    }
}
