let responseData;
let leaves = [];

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
                $('#newProduct')[0].reset();
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
            $('#myTable').DataTable();

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

    let html = ' <table id="myTable" class="table table-striped table-bordered" cellspacing="0" width="100%"><thead><tr>' +
        generateColumnsRecursive(data.column) +
        '</tr></thead><tbody>' + generateRows(data) +
        '</tbody></table>';

    return html;
}

function generateColumnsRecursive(columns) {
    let html = '';

    columns.forEach(function (element) {

        if (element['subHeaders']) {
            html += generateColumnsRecursive(element['subHeaders']);
        } else {
            html += '<th>';
            html += element.header;
            html += '</th>';
            if (element.field) {
                leaves.push(element.field);
            } else {
                leaves.push(element.header);
            }
        }
    });

    return html;

}

function generateRows(data) {
    let html = '';

    data.data.forEach((row) => {
        row['Total sales'] = row.salesQ1 + row.salesQ2 + row.salesQ3 + row.salesQ4;
        html += generateOneRow(row);
    });
    return html;
}

function generateOneRow(row) {
    let html = '<tr>';
    leaves.forEach(el => {
        html += '<td>';
        html += row[el];
        html += '</td>';
    });

    html += '</tr>';
    return html;
}





