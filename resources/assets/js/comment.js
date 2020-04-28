$('.comment-delete').on('click', function (event) {
    event.preventDefault();
    var el = this;
    const url = $(this).attr('href');
    const deleteTitle = $(this).attr('data-title');
    const commentId = $(this).attr('data-id');
    const errorMessage = $(this).attr('data-error');
    swal({
        title: deleteTitle,
        icon: 'warning',
        buttons: true,
        dangerMode: true,
    }).then(function(value) {
        if (value) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    _token: CSRF_TOKEN,
                    id: commentId
                },
                dataType: 'JSON',
                success: function (results) {
                        $('.comment'+commentId).remove()
                },
                error: function () {
                    swal(errorMessage, {
                        icon: "error",
                    });
                }
            });
        }
    });
});
