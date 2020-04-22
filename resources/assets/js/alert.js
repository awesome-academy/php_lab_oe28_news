$('.delete-confirm').on('click', function (event) {
    event.preventDefault();
    var el = this;
    const url = $(this).attr('href');
    const deleteConfirm = $(this).attr('data-confirm');
    const deleteTitle = $(this).attr('data-title');
    const errorMessage = $(this).attr('data-error');
    swal({
        title: deleteTitle,
        text: deleteConfirm,
        icon: 'warning',
        buttons: true,
        dangerMode: true,
    }).then(function(value) {
        if (value) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'DELETE',
                url: url,
                data: {_token: CSRF_TOKEN},
                dataType: 'JSON',
                success: function (results) {
                    swal(results.success, {
                        icon: "success",
                    }).then(function (){
                        el.closest('tr').remove()
                    });
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

$('.category-delete-confirm').on('click', function (event) {
    event.preventDefault();
    var el = $(this);
    const url = $(this).attr('href');
    const deleteConfirm = $(this).attr('data-category-confirm');
    const deleteTitle = $(this).attr('data-category-title');
    const errorMessage = $(this).attr('data-category-error');
    swal({
        title: deleteTitle,
        text: deleteConfirm,
        icon: 'warning',
        buttons: true,
        dangerMode: true,
    }).then(function(value) {
        if (value) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'DELETE',
                url: url,
                data: {_token: CSRF_TOKEN},
                dataType: 'JSON',
                success: function (results) {
                    swal(results.message, {
                        icon: "success",
                    }).then(function (){
                        el.closest('p').remove();
                    });
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
