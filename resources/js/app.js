import './bootstrap';

window.Echo.channel('filestatus')
    .listen('.filestatusevent', (e) => {
        location.reload();
    });
