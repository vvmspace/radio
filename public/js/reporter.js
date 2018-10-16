$(function(){
    $('audio').on('error', function(){
        let id = $(this).data('id');
        $.getJSON('/report/error/' + id, function (station) {
            alert(station.name + ' stream error reported. Thank you. It is better and it will be better.');
            document.location.reload();
        });
    });
});