$(function () {
    $(document).on('click', '#action-create-checkout', function () {
        var shopId = $('#shopId').val();
        console.log()
        if (!shopId) {
            return false;
        }

        document.location.href = '/data/checkout/create-by-shop?shopId=' + shopId;
        // window.location.href('/data/checkout/fill/' + shopId);
    });
});
