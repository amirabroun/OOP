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
                                        <div class="col-lg-6 mb-4">
                                            <label>عنوان:</label>
                                            <input type="text" name="title" class="form-control" value="<?php echo $product->title ?>">
                                        </div>
                                        <? #php $categories = App\Models\Category::getCategories(); 
                                        ?>
                                        <!-- <div <? #php echo (!$categories) ? 'hidden' : null 
                                                    ?> class="col-lg-6">
                                            <label>دسته بندی:</label>
                                            <select multiple name="category[]" title="دسته بندی را انتخاب کنید..." class="form-control selectpicker" data-size="7" data-live-search="true">
                                                <?php
                                                if ($categories) {
                                                    foreach ($categories as $category) { ?>
                                                        <option value="<?php echo $category->id ?>"><?php echo $category->title ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <span class="form-text text-muted">برند محصول را انتخاب نمایید </span>
                                        </div> -->
                                        <div class="col-lg-6 mb-3">
                                            <label>قیمت:</label>
                                            <input type="text" name="price" class="form-control" value="<?php echo $product->price ?>">
                                        </div>
                                        <div class="col-lg-6">
                                            <label>با تخفیف:</label>
                                            <input type="text" name="price_discounted" class="form-control" value="<?php echo $product->price_discounted ?>">
                                        </div>
                                        <div class="col-lg-6 mb-4">
                                            <label>تعداد:</label>
                                            <input type="number" name="stock" class="form-control" value="<?php echo $product->stock ?>">
                                        </div>

                                        <div <?php echo (!$brands = $product->brand_title) ? 'hidden' : null; ?> class="col-lg-6">
                                            <label>برند:</label>
                                            <select name="brand" title="<?php echo $brand->title ?>" class="form-control selectpicker" data-size="7" data-live-search="true">
                                                <?php
                                                if ($brands) {
                                                    foreach ($brands as $brand) { ?>
                                                        <option value="<?php echo $brand->id ?>"><?php echo $brand->title ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <span class="form-text text-muted">برند محصول را انتخاب نمایید </span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <label>توضیحات:</label>
                                            <textarea class="form-control" name="description" id="product_description" rows="3"></textarea>
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
<?php include "Views/partials/footer.php"; ?>