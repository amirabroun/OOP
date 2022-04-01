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

                                                    <a href="javascript:;" data-target="#edit_product" data-toggle="tooltip" data-theme="dark" class="text-dark text-hover-danger category btn-show-description" type="button" data-title="حذف">
                                                        <?php echo $category->title; ?>
                                                    </a> /
                                            <?php
                                                }
                                            }

                                            if (isEmpty($last_parent_id)) {
                                                $categories = \App\Models\Category::getCategoryParents();
                                            } else {
                                                $categories = \App\Models\Category::getCategoryChild($last_parent_id);
                                            } ?>
                                            <a href="javascript:;" title="افزودن دسته بندی" data-toggle="modal" data-theme="dark" data-target="#kt_select2_modal" class="text-success">
                                                / + /
                                            </a>
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

<div class="modal fade" id="kt_select2_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">انتخاب دسته بندی</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="" method="post">
                    <input type="hidden" name="id">
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3 col-sm-12">
                            دسته بندی ارشد :
                        </label>
                        <!-- <php if ($categories) { -->
                        <!-- foreach ($categories as $category) { > -->
                        <!--  <option value="<php echo $category->id >"><php echo $category->title ></option> -->
                        <!-- <php -->
                        <!-- }
                        }
                        ?> -->
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <select class="form-control select2" id="kt_select2_2_modal" name="param">
                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                    <option value="AK">Alaska</option>
                                    <option value="HI">Hawaii</option>
                                </optgroup>
                                <optgroup label="Pacific Time Zone">
                                    <option value="CA">California</option>
                                    <option value="NV" selected="selected">Nevada</option>
                                    <option value="OR">Oregon</option>
                                    <option value="WA">Washington</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <!-- // -->
                    <?php
                    $categories_parent = \App\Models\Category::getCategoryParents();

                    ?>
                    <?php if ($categories) {
                        foreach ($categories as $category) { ?>
                            <!-- <option value="<?php $category->id ?>"><?php $category->title ?></option> -->
                    <?php
                        }
                    }
                    ?>
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3 col-sm-12">
                            Multi Select
                        </label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <select class="form-control select2" id="kt_select2_3_modal" name="param" multiple="multiple">
                                <?php foreach ($categories_parent as $category_parent) { ?>
                                    <optgroup label="<?php echo (' # ' . $category_parent->title) ?>">
                                        <?php $categories_child = \App\Models\Category::getCategoryChild($category_parent->id);
                                        if ($categories_child) {
                                            foreach ($categories_child as $category_child) { ?>
                                                <option class="option-control" value="AK">
                                                    <?php echo "\t" . $category_child->title ?>
                                                </option>
                                                <?php $categories_child2 = \App\Models\Category::getCategoryChild($category_child->id);
                                                if ($categories_child2) {
                                                    foreach ($categories_child2 as $category_child2) { ?>
                                                        <option class="option-control" value="AK">
                                                            <?php echo "\t" . $category_child2->title ?>
                                                        </option>
                                                        <?php $categories_child3 = \App\Models\Category::getCategoryChild($category_child->id);
                                                        if ($categories_child3) {
                                                            foreach ($categories_child3 as $category_child3) { ?>
                                                                <option class="option-control" value="AK">
                                                                    <?php echo "\t" . $category_child3->title ?>
                                                                </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        <?php
                                                        }
                                                        ?>
                                                    <?php
                                                    }
                                                    ?>
                                                <?php
                                                }
                                                ?>
                                            <?php
                                            } ?>
                                        <?php
                                        } ?>

                                        <!-- <option value="HI" selected="selected">Hawaii</option> -->
                                    <?php
                                } ?>
                                    </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3 col-sm-12">Placeholder</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <select class="form-control select2" id="kt_select2_4_modal" name="param">
                                <option label="Label"></option>
                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                    <option value="AK">Alaska</option>
                                    <option value="HI">Hawaii</option>
                                </optgroup>
                                <optgroup label="Pacific Time Zone">
                                    <option value="OR">Oregon</option>
                                    <option value="WA">Washington</option>
                                </optgroup>
                                <optgroup label="Mountain Time Zone">
                                    <option value="AZ">Arizona</option>
                                    <option value="CO">Colorado</option>
                                    <option value="ID">Idaho</option>
                                    <option value="WY">Wyoming</option>
                                </optgroup>
                                <optgroup label="Central Time Zone">
                                    <option value="AL">Alabama</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="WI">Wisconsin</option>
                                </optgroup>
                                <optgroup label="Eastern Time Zone">
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="IN">Indiana</option>
                                    <option value="WV">West Virginia</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>

                    <!-- <div class="form-group row">
                        <div class="col-lg-6">
                            <label>عنوان:</label>
                            <input type="text" name="title" class="form-control" placeholder="عنوان محصول را وارد کنید..." />
                        </div>
                        <div class="col-lg-6">
                            <label>زیر دسته :‌</label>
                            <select name="brand" title="انتخاب زیر دسته" class="form-control selectpicker" data-size="7" data-live-search="true">
                                <php
                                if ($categories) {
                                    foreach ($categories as $category) {
                                ?>
                                        <option value="<\php echo $category->id ?>"><php echo $category->title ?></option>
                                <php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div> -->
                    <!-- <div class="form-group row">
                        <div class="col-lg-12">
                            <label>توضیحات:</label>
                            <textarea class="form-control" name="description" id="product_description" rows="3"></textarea>
                        </div>
                    </div> -->
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