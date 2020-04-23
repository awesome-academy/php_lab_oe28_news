$(".love").each(function(){
    $(this).find("div").html($.number($(this).find("div").html()));
    var ob = $(this);
    var url = null;
    var slugNews = $(this).attr('data-slug');
    var errorMessage = $(this).attr('data-error');
    var countNow = $(this).find("div").html().replace(',', '');
    $(this).click(function(){
        url = ob.attr('data-href1');
        if (!$(this).hasClass('block-click')) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    _token: CSRF_TOKEN,
                    slug: slugNews
                },
                dataType: 'JSON',
                success: function (results) {
                    if(!ob.hasClass("active")) {
                        ob.find(".animated").remove();
                        ob.addClass("active");
                        ob.find("i").removeClass("ion-android-favorite-outline");
                        ob.find("i").addClass("ion-android-favorite");
                        ob.find("div").html(parseInt(countNow++) + 1);
                        ob.find("div").html($.number(ob.find("div").html()));
                        ob.append(ob.find("i").clone().addClass("animated"));
                        ob.find("i.animated").on("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function(e){
                            $(this).remove();
                            $(this).off(e);
                        });
                    } else {
                        ob.find(".animated").remove();
                        ob.removeClass("active");
                        ob.find("i").addClass("ion-android-favorite-outline");
                        ob.find("i").removeClass("ion-android-favorite");
                        ob.find("div").html(parseInt(countNow--) - 1);
                        ob.find("div").html($.number(ob.find("div").html()));
                    }
                },
                error: function () {
                    alert(errorMessage);
                }
            });
        }
        return false;
    });
});
