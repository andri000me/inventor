

function updatePengajuan(id = null) {

    if (id) {

        $("#updateForm")[0].reset();
        $('.form-group').removeClass('has-error').removeClass('has-success');
        $('.text-danger').remove();

        $.ajax({
            url: 'pengajuan/get_id/' + id,
            type: 'post',
            dataType: 'json',
            success: function(response) {
                $("#ecatatan").val(response.catatan);
                $("#jumlah_pengajuan").val(response.jumlah_pengajuan);


                $("#updateForm").unbind('submit').bind('submit', function() {

                    var form = $(this);
                     status: $("input[type='checkbox']:checked").val();
                    $.ajax({
                        url: form.attr('action') + '/' + id,
                        type: 'post',
                        data: form.serialize(), status,
                        dataType: 'json',
                        success: function(response) {
                                if (response.success === true) {
                                    $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                        '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                                        '</div>');
                                    setTimeout(function() {
                                        $(".messages").empty();
                                    }, 3000);
                                    $("#updateModal").modal('toggle');
                                    location.reload();

                                } else {
                                    $('.text-danger').remove()
                                    if (response.messages instanceof Object) {
                                        $.each(response.messages, function(index, value) {
                                            var id = $("#" + index);

                                            id
                                                .closest('.form-group')
                                                .removeClass('has-error')
                                                .removeClass('has-success')
                                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                                .after(value);

                                        });
                                    } else {
                                        $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                            '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                                            '</div>');
                                    }
                                }
                            } // /succes


                    }); // /ajax

                    return false;
                });

            }
        });
    } else {
        alert('error');
    }
}