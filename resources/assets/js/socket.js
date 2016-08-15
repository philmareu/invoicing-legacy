channel.bind('Invoicing\\Events\\TimeTic', function(data) {
    $('.timer').text(data.timer);
    document.title = 'Timer: ' + data.timer;
});