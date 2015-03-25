$(function() {
    function notify(text, options) {
        // Let's check if the browser supports notifications
        if (!("Notification" in window)) {
            return;
        }

        // Let's check if the user is okay to get some notification
        else if (Notification.permission === "granted") {
            // If it's okay let's create a notification
            var notification = new Notification(text, options);
            setTimeout(function() {
                notification.close()
            }, PusherData.close_in * 1000);
        }

        // Otherwise, we need to ask the user for permission
        else if (Notification.permission !== 'denied') {
            Notification.requestPermission(function (permission) {
                // If the user is okay, let's create a notification
                if (permission === "granted") {
                    var notification = new Notification(text, options);
                    setTimeout(function() {
                        notification.close()
                    }, PusherData.close_in * 1000);
                }
            });
        }
    }

    // able to push notifications
    if ("Notification" in window) {

        if (PusherData.notifications.created || PusherData.notifications.incoming) {
            var pusher = new Pusher(PusherData.app_key);
            var channel = pusher.subscribe(PusherData.channel);
        }

        if (PusherData.notifications.created) {
            channel.bind('delivery.created', function(data) {
                data = JSON.parse(data.message);
                data.delivery = parseInt(data.delivery);
                
                var date = new Date(),
                    currentTime = date.getHours() + ':' + date.getMinutes();

                if (data.user != PusherData.user) {
                    notify(currentTime + ' - Delivery created!', {
                        body: data.store + ' by ' + data.user,
                        icon: '/assets/images/new.png'
                    });
                }
            });
        }

        if (PusherData.notifications.incoming) {
            channel.bind('delivery.incoming', function(data) {
                data = JSON.parse(data.message);
                data.delivery = parseInt(data.delivery);
                
                var date = new Date(),
                    currentTime = date.getHours() + ':' + date.getMinutes();

                if (data.user != PusherData.user && PusherData.deliveries.indexOf(data.delivery) > -1) {
                    notify(currentTime + ' - Delivery incoming!', {
                        body: data.store + '  by ' + data.user,
                        icon: '/assets/images/incoming.png'
                    });
                }
            });
        }

    }

});
