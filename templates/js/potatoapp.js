let responseData;

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
            let gridHtml = generateGrid(data);
            console.log('grid: ', gridHtml);

            $('#saleReports').html(gridHtml);
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

function generateGrid(data) {
    responseData = data;

    let html = '<div class="row bg-light">' + generateColumnsRecursive(data.column) + '</div>';
    return html;
}

function generateColumnsRecursive(columns) {
    let html = '';

    columns.forEach(function (element) {

        if (element['subHeaders']) {
            html += '<div class="col border"><div class="row">' + element['header'] + '</div>';
            html += '<div class="row">';
            html += generateColumnsRecursive(element['subHeaders']);
            html += '</div></div>';

        } else {
            html += generateOneColumn(element);
            html += '</div>' + populateColumn(element['field']) + '</div>';
        }
    });

    return html;

}

function generateOneColumn(columnHeader) {
    console.log('element', columnHeader);
    let title = columnHeader['header'];

    return '<div class="col border"><div class="row">' + title;
}

function populateColumn(columnName) {
    // debugger;
    let columnHtml = '';
    console.log(columnName);
    if (columnName) {
        let dataToProcess = responseData.data;
        let allColumnData = dataToProcess.map(a => a[columnName]);
        allColumnData.forEach((el) => {
            columnHtml += '<div class="row">' + el + '</div>';
        });
        console.log(columnHtml);

    }
    return columnHtml;
}


