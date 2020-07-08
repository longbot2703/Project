$(document).ready(function() {
    $('.date').datepicker({
        dateFormat: "dd/mm/yy"
    });

    $(document).on("wheel", "input[type=number]", function(e) {
        $(this).blur();
    });

    $('#addImg').click(function() {
        $('#DivImgAdd').empty();
        selectFileWithCKFinder('valUrl');
    });

    $('.number').on('input', function(e) {
        $(this).val(formatCurrency(this.value.replace(/[,VNĐ]/g, '')));
    }).on('keypress', function(e) {
        if (!$.isNumeric(String.fromCharCode(e.which))) e.preventDefault();
    }).on('paste', function(e) {
        var cb = e.originalEvent.clipboardData || window.clipboardData;
        if (!$.isNumeric(cb.getData('text'))) e.preventDefault();
    });
});

function selectFileWithCKFinder(elementId) {
    CKFinder.popup({
        chooseFiles: true,
        width: 800,
        height: 600,
        onInit: function(finder) {
            finder.on('files:choose', function(evt) {
                var file = evt.data.files.first();
                var output = document.getElementById(elementId);
                output.value = file.getUrl();
                $('#DivImgAdd').append('<div class="col-sm-12 col-md-12 col-lg-12"><img src="' + output.value + '" id="image" style="height:160px;" /></div>');
            });

            finder.on('file:choose:resizedImage', function(evt) {
                var output = document.getElementById(elementId);
                output.value = evt.data.resizedUrl;
            });
        }
    });
}

function formatCurrency(number) {
    var n = number.split('').reverse().join("");
    var n2 = n.replace(/\d\d\d(?!$)/g, "$&,");
    return n2.split('').reverse().join('');
}