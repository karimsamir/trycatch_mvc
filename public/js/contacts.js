function ajaxGetAllContacts() {
    // Call you server with ajax to get al contacts

    $.ajax({
        dataType: "json",
        url: "/contacts/ajaxgetallcontacts",
        success: function (result) {

            if (result.length > 0) {
                for (i = 0; i < result.length; i++) {
                    var row = 
                        '<tr>' +
                            '<td>' +
                                '<a href="/contacts/' + result[i].id + '"> ' +
                                    result[i].name +
                                '</a>' +
                            '</td>' +
                            '<td>' + result[i].phone + '</td>' +
                            '<td>' + result[i].address + '</td>' +
                            '<td>' +
                                '<a href="/contacts/' + result[i].id + '/edit">' +
                                '   <button class="btn btn-xs btn-primary">' +
                                    'Edit' +
                                    '</button>' +
                                '</a>' +    
                                
                                '  <a href="/contacts/delete/' + result[i].id + '">' +
                                    '<button class="btn btn-xs btn-danger">' +
                                    ' Delete' +
                                    '</button>' +
                                '</a>' +
                            '</td>' +
                        '</tr>';
                
                        $("#tblContacts tbody").append(row);
                }
            }
            else{
                var row = 
                    '<tr>' +
                        '<td colspan="4">' +
                            'no contact found ' +

                        '</td>' +
                    '</tr>';

                $("#tblContacts").find("thead").append(row);
            }

        }
    });
}