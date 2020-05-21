$('#photo_submit').on('click', function(event){
    event.preventDefault();
    var file = $('#photo_input').prop('files')[0];
    var form_data = new FormData();
    form_data.append('photo', file);
    var urlPhoto = $(this).attr('data-href');
    var content = $("#news_content");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: urlPhoto,
        data: form_data,
        contentType: false,
        dataType:'json',
        processData: false,
        cache:false,
        success:function(data)
        {
            photoName = data.success;
            text = content.val();
            content.val(
                text + '<br>' + "<img src=\"/images/news/"+ photoName + "\" class=\"rounded\" alt=\"...\">" + '<br>'
            );
        },
        error: function (data) {
            swal("", {
                icon: "error",
                title: content.attr('data-error'),
            });
        }
    })
});
