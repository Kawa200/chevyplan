$(document).ready(function() {
    $('#payments-form').validate({
        rules: {
            doctype: {
                required: true,
            },
            docnum: {
                required: true,
                minlength: 5,
                maxlength: 10,
                digits: true
            }
        }
    });
});

$('.row').on('submit', '#payments-form', function () {
    event.preventDefault();
    console.log('Tipo de documento:', $('#doctype').val());
    console.log('Número de documento:', $('#docnum').val());

    $("#results-container").hide();
    $("#client-name").html('');
    $("#results").html('');

    const form = $('#payments-form');
    $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: form.serialize(),
        success: function(response){

            let dataBody = '';

            for (let item of response.data) {

                dataBody += `
                    <tr>
                        <th scope="row">${ item.num_plan }</th>
                        <td>${ item.valor }</td>
                        <td>${ item.vencimiento }</td>
                        <td>${ item.vigencia }</td>
                    </tr>
                `;
            }

            $("#client-name").html(response.nombre);
            $("#results").html(dataBody);
            $("#results-container").fadeIn();
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No hay registros con los datos consultados.'
            })
        }
    });
});
