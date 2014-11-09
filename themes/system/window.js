function endMove() {
    $(this).removeClass('movable');
}

function startMove() {
    $('.movable').on('mousemove', function(event) {
        var thisX = event.pageX - $(this).width() / 2,
            thisY = event.pageY - $(this).height() / 2;

        $('.movable').offset({
            left: thisX,
            top: thisY
        });
    });
}
$(document).ready(function() {
    $("#containerDiv").on('mousedown', function() {
        $(this).addClass('movable');
        startMove();
    }).on('mouseup', function() {
        $(this).removeClass('movable');
        endMove();
    });

});