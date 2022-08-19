$(function () {

    $(document).on('click', '#action-add-checkout-item', function () {
        var formData = $('#form-checkout-item').serialize();
        $.ajax({
            url: '/data/checkout/add-item',
            method: 'post',
            data: formData,
            success: function (response) {
                console.log(response);
                $.pjax.reload('#pjax-checkout-item-list', {
                    timeout : false
                });
            },
            error: function (error) {
                console.log(error.responseText);
            }
        });
    });

    $(document).on('click', '.action-remove-checkout-item', function () {
        var id = $(this).data('id');
        $.ajax({
            url: '/data/checkout/remove-item',
            method: 'get',
            data: {
                id: id
            },
            success: function (response) {
                console.log(response);
                $.pjax.reload('#pjax-checkout-item-list', {
                    timeout : false
                });
            },
            error: function (error) {
                console.log(error.responseText);
            }
        });
    })
});
