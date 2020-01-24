function setAddNewProductBehavior() {
    //add new product behavior
    $("#newProduct").submit(function (event) {
        event.preventDefault();

        let formData = {
            'productName': $('#productName').val(),
            'productId': $('#productID').val(),
            'productManager': $('#productManager').val(),
            'salesStartDate': $('#salesStartDate').val()
        };

        makeApiCall('/api/product', formData)
            .done(function (data) {
                showToast("Server Response", data.result);
            });
    });

    $('#resetNewProductForm').click(function () {
        $('#newProduct')[0].reset();
    });

}

function setSalesReportsBehavior() {
    //display data grid behavior
    makeApiCall('/api/sales/potato', {}, 'GET')
        .done(function (data) {
            console.log("Server Response", data);
            generateGrid(data.column, false);
        });
}

function showToast(headerTxt, bodyTxt) {
    $('.toast-body').text(bodyTxt);
    $('.toast-header').text(headerTxt);
    $('.toast').toast({delay: 5000});
    $('.toast').toast('show');
}

function makeApiCall(url, data, method) {
    method = method || 'POST';
    return $.ajax({
        type: method,
        url: url,
        data: data,
        dataType: 'json',
        encode: true
    })
}

function generateGrid(columns) {
    let html = '<div class="row bg-light">' + generateColumnsRecursive(columns) + '</div>';
    console.log(html);
}

function generateColumnsRecursive(columns) {
    let html = '';

    columns.forEach(function (headerElement) {

        if (headerElement['subHeaders']) {
            html += '<div class="col border"><div class="row">' + headerElement['header'] + '</div>';
            html += '<div class="row">';
            html += generateColumnsRecursive(headerElement['subHeaders'], true);
            html += '</div></div>';

        } else {
            html += generateOneColumn(headerElement['header'], false);
            html += '</div>';
        }
    });

    return html;

}

function generateOneColumn(rowText, withInRow) {
    if (withInRow) {
        return '<div class="row"><div class="col">' + rowText;
    }

    return '<div class="col border">' + rowText;
}
