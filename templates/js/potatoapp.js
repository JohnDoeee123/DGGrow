//Don't show pages that cached in the browser on back button
window.addEventListener("pageshow", function (event) {
    var historyTraversal = event.persisted ||
        (typeof window.performance != "undefined" &&
            window.performance.navigation.type === 2);
    if (historyTraversal) {
        // Handle page restore.
        window.location.reload();
    }
});

let potatoAppModule = (() => {
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
                let gridHtml = generateGrid(data);

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

        let html = '<table id="myTable" class="table table-striped table-bordered productTableGrid" cellspacing="0"" width="100%"">' +
            '<thead>' +
            generateHeaderRecursive(data.column) +
            '</thead><tbody>' +
            generateDataRows(data) +
            '</tbody></table>';

        return html;
    }

    function generateHeaderRecursive(columns) {
        let result = composeHeaderRecursive(columns);
        return (result.length == 2) ? `<tr>${result[0]}</tr><tr>${result[1]}</tr>` : `<tr>${result[0]}</tr>`;
    }

    function composeHeaderRecursive(columns, isChild) {
        let htmlParentRow = '';
        let htmlChildRow = '';

        columns.forEach(function (element) {

            if (element['subHeaders']) {
                htmlParentRow += '<th class="parentWithSubHeaders" colspan="' + element['subHeaders'].length + '">';
                htmlParentRow += element.header;
                htmlParentRow += '</th>';

                htmlChildRow += composeHeaderRecursive(element['subHeaders'], true)[1];
            } else {
                if (isChild) {
                    htmlChildRow += '<th class="childElHeadCell">';
                    htmlChildRow += element.header;
                    htmlChildRow += '</th>';

                } else {
                    htmlParentRow += '<th class="parentWithoutSubHeaders" rowspan="2">';
                    htmlParentRow += element.header;
                    htmlParentRow += '</th>';
                }

                if (element.field) {
                    leaves.push(element.field);
                } else {
                    leaves.push(element.header);
                }
            }
        });

        return [htmlParentRow, htmlChildRow];
    }

    function generateDataRows(data) {
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

    //export module utility functions
    return {
        setSalesReportsBehavior: setSalesReportsBehavior,
        setAddNewProductBehavior: setAddNewProductBehavior
    };

})();