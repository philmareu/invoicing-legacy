channel.bind('Invoicing\\Events\\TimeTic', function(data) {
    $('.timer').text(data.timer);
    document.title = 'WorkTop | Timer: ' + data.timer;
});