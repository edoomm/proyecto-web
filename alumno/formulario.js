$(document).ready(function () {
    $('.datepicker').datepicker();
    $('select').formSelect();
    $('.tabs').tabs();
    $("form").validetta({
        bubblePosition: 'bottom',
        bubbleGapTop: 10,
        bubbleGapLeft: -5
    });
});
