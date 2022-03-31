<?php include "Views/partials/header.php";
include "Views/partials/aside.php"; ?>
<div class="d-flex flex-column-fluid mb-20">
    <!--begin::Container-->
    <div class="container mb-6">
        <div class="card card-custom">
            <div class="card-body p-0">
                <!--begin: Wizard-->
                <div class="wizard wizard-3" id="kt_wizard_v3" data-wizard-state="step-first" data-wizard-clickable="true">
                    <!--begin: Wizard Body-->
                    <div class="row justify-content-center py-10 px-8 py-lg-12 px-lg-10">
                        <div class="col-xl-12 col-xxl-7">
                            <!--begin: Wizard Form-->
                            <?php $product = \App\Models\Product::getProduct($id); ?>
                            <form class="form" id="kt_form" method="POST" action="">
                                <input type="hidden" name="action" value="update_product">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-lg-6 mb-6">
                                            <label>عنوان :</label>
                                            <input type="text" name="title" class="form-control" value="<?php echo $product->title ?>">
                                        </div>
                                        <div class="col-lg-6 mb-6">
                                            <?php $brands = App\Models\Brand::getBrands(); ?>
                                            <label>برند :</label>
                                            <select name="brand" title="برند" class="form-control selectpicker" data-size="7" data-live-search="true">
                                                <?php if ($brands) {
                                                    foreach ($brands as $brand) { ?>
                                                        <option value="<?php echo $brand->id ?>"><?php echo $brand->title ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 mb-6">
                                            <label>قیمت :</label>
                                            <input type="text" name="price" class="form-control" value="<?php echo $product->price ?>">
                                        </div>
                                        <div class="col-lg-4 mb-6">
                                            <label>با تخفیف :</label>
                                            <input type="text" name="price_discounted" class="form-control" value="<?php echo $product->price_discounted ?>">
                                        </div>
                                        <div class="col-lg-4 mb-6">
                                            <label>تعداد :</label>
                                            <input type="number" name="stock" class="form-control" value="<?php echo $product->stock ?>">
                                        </div>
                                        <div class="col-lg-12 mt-3">
                                            <?php $categories = \App\Models\Product::getCategories($product->id); ?> دسته بندی : 
                                            <?php $last_parent_id = null;
                                            if ($categories) {
                                                foreach ($categories as $category) {
                                                    $last_parent_id = $category->id; ?>
                                                    <a href="javascript:;" data-target="#edit_product" data-toggle="tooltip" data-theme="dark" class="text-dark text-hover-warning category btn-show-description" type="button" data-title="حذف" data-toggle="modal">
                                                        <?php echo $category->title; ?>
                                                    </a> /
                                            <?php
                                                }
                                            }

                                            if (isEmpty($last_parent_id)) {
                                                $categories = \App\Models\Category::getCategoryParents();
                                            } else {
                                                # code...
                                            } ?>



                                            <button href="javascript:;" 
                                            title="انتخاب دسته بندی" 
                                            data-toggle="tooltip" 
                                            data-theme="dark"
                                            data-categories="<?php $categories ?>"
                                            id="select_categories" 
                                            class="text-success">
                                            / + /
                                        </button>
                                        
                                        
                                        
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-12 mb-6">
                                            <label>توضیحات:</label>
                                            <textarea class="form-control" name="description" id="product_description" rows="3"><?php echo $product->description ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="submit" class="btn btn-primary mr-2">ثبت</button>
                                            <button type="reset" class="btn btn-secondary">خالی کردن فرم</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!--end: Wizard Form-->
                        </div>
                    </div>
                    <!--end: Wizard Body-->
                </div>
                <!--end: Wizard-->
            </div>
        </div>
    </div>
    <!--end::Container-->
</div>

<div class="modal fade" id="edit_product" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ویرایش «<span id="edit_product_title"></span>»</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="" method="post">
                    <input type="hidden" name="id">
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>عنوان:</label>
                            <input type="text" name="title" class="form-control" placeholder="عنوان محصول را وارد کنید..." />
                        </div>
                        <?php $brands = App\Models\Brand::getBrands() ?>
                        <div <?php echo (!$brands) ? 'hidden' : null ?> class="col-lg-6">
                            <label>انتخاب برند</label>
                            <select name="brand" title="برند" class="form-control selectpicker" data-size="7" data-live-search="true">
                                <?php
                                if ($brands) {
                                    foreach ($brands as $brand) {
                                ?>
                                        <option value="<?php echo $brand->id ?>"><?php echo $brand->title ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <span class="form-text text-muted">برند را انتخاب نمایید.</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>توضیحات:</label>
                            <textarea class="form-control" name="description" id="product_description" rows="3"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="submit_update_product" type="button" class="btn btn-light-success font-weight-bold">ثبت تغییرات</button>
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>
<?php include "Views/partials/footer.php"; ?>