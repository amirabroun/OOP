//update section brands
$('#select_categories').on('click', function () {
    const $this = $(this);
    const title_brand = $this.data('title');
    const desc_brand = $this.data('description');
    const id_brand = $this.data('id-brand');
    const modal = $('#show-edit-brands');
    modal.find('#edit-brand-title').html(title_brand);
    modal.find('input[name=id]').val(id_brand);
    modal.find('input[name=title]').val(title_brand);
    modal.find('textarea[name=description]').val(desc_brand);
});
//show sweet alert update section
$('#select_categories').on('click', function () {
    const $this = $(this);
    const $categories = $this.data('categories');
    const $desc = $this.data('desc');
    $('#edit_product').html($categories);
    $('#edit_product').html($desc);
    const $modal_brand = $(document).find('#show-edit-brands');
    const title_brand = $modal_brand.find("input[name='title']").val();
    const id_brand = $modal_brand.find("input[name='id']").val();
    const description_brand = $modal_brand.find("textarea[name='description']").val();
    console.log(id_brand);
    // $.ajax({
    //     url: '/routes/web.php',
    //     dataType: 'json',
    //     method: 'post',
    //     data: {
    //         id_brand: id_brand,
    //         title_brand: title_brand,
    //         description_brand: description_brand,
    //         action: 'edit-brand',
    //     },
    //     success: function (response) {
    //         if (response.status === 200) {
    //             Swal.fire({
    //                 title: response.message.title,
    //                 html: response.message.text,
    //                 icon: response.message.type,
    //                 buttonsStyling: false,
    //                 confirmButtonText: "متوجه شدم!",
    //                 customClass: {
    //                     confirmButton: "btn btn-primary"
    //                 }
    //             }).then(function (done) {
    //                 if (done.isConfirmed === true) {
    //                     window.location.reload();
    //                 }
    //             });
    //         } else {
    //             Swal.fire({
    //                 title: response.message.title,
    //                 html: response.message.text,
    //                 icon: response.message.type,
    //                 buttonsStyling: false,
    //                 confirmButtonText: "متوجه شدم!",
    //                 customClass: {
    //                     confirmButton: "btn btn-danger"
    //                 }
    //             });
    //         }
    //     },
    //     error: function (response) {
    //         console.log("Error:", response);
    //     }
    // });
});

$('.btn-show-description').on('click', function () {
    const $this = $(this);
    const $title = $this.data('title');
    const $desc = $this.data('desc');
    $('#show_description #product_title').html($title);
    $('#show_description #product_description').html($desc);
});
