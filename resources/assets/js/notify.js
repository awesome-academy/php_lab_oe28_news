var notificationsWrapper = $('.notifi-dropdown');
var notificationsCount = $(notificationsWrapper).attr('data-count');
var pusherKey = $(notificationsWrapper).attr('data-key');
var notifyTitle = $(notificationsWrapper).attr('data-title');
var userId = $(notificationsWrapper).attr('data-id');
var linkRead = $(notificationsWrapper).attr('data-link');
Pusher.logToConsole = true;

var pusher = new Pusher(pusherKey, {
    cluster: 'ap1'
});

var channel = pusher.subscribe('send-message');

channel.bind('news-event', function(data) {
    if (data.notification.notifiable_id == userId) {
        notificationsCount++;
        var notifyItem = '<div class="notifi__item">' +
            '<div class="bg-c3 img-cir img-40">' +
            '<i class="zmdi zmdi-email"></i>' +
            '</div>' +
            '<div class="content">' +
            '<p>' + notifyTitle + '</p>' +
            '<a href="' + linkRead + '/' + data.notification.id + '">' + data.notification.data.title + '</a><br>' +
            '<span class="date">' + data.notification.data.time + '</span>' +
            '</div>\n' +
            '</div>';

        $('.notify-count').remove();
        $(notificationsWrapper).before('<span class="quantity notify-count">' + notificationsCount + '</span>');
        $(notificationsWrapper).prepend(notifyItem);
        notificationsWrapper.show();
    }
});
