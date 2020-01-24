$(document).ready(function () {

    $("#newProduct").submit(function (event) {
        event.preventDefault();

        let formData = {
            'productName': $('#productName').val(),
            'productId': $('#productID').val(),
            'productManager': $('#productManager').val(),
            'salesStartDate': $('#salesStartDate').val()
        };

        $.ajax({
            type: 'POST',
            url: '/api/product',
            data: formData,
            dataType: 'json',
            encode: true
        })
            .done(function (data) {
                showToast("Server Response", data.result);
            });
    });

    $('#resetNewProductForm').click(function () {
        $('#newProduct')[0].reset();
    });

});

function showToast(headerTxt, bodyTxt) {
    $('.toast-body').text(bodyTxt);
    $('.toast-header').text(headerTxt);
    $('.toast').toast({delay: 5000});
    $('.toast').toast('show');
}

function makeApiCall(){
    
}