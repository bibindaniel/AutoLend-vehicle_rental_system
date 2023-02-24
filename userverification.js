$(document).ready(function () {
    $("#btn").click(function () {
        $('#exampleModal').modal('toggle')
    })
    var check = 1;
    var check1 = 1;
    var check2 = 1;
    $("#licenceno").keyup(function () {
        var mobile = document.getElementById("licenceno").value
        var c_mobile = /^(([A-Z]{2}[0-9]{2})( )|([A-Z]{2}-[0-9]{2}))((19|20)[0-9][0-9])[0-9]{7}$/;
        var r_mobile = c_mobile.test(mobile)
        if (r_mobile == false) {
            check = 1;
            $("#licenceno1").text("*Enter a valid mobile number");
        } else {
            check = 0;
            $("#licenceno1").text("");
            $('#btn1').prop("disabled", false);

        }
    })
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }

    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("expirydate").setAttribute("min", today);
    $("#expirydate").change(function () {
        var r_date = document.getElementById("expirydate").value
        var today = new Date();
        r_date = new Date(r_date);
        var millisBetween = today.getTime() - r_date.getTime();
        var days = millisBetween / (1000 * 3600 * 24);
        var final_date = Math.round(Math.abs(days));
        if (final_date < 10) {
            check1 = 1;
            $("#expirydate1").text("*Please renew your licence");
        } else {
            check1 = 0;
            $("#expirydate1").text("");
            $('#btn1').prop("disabled", false);

        }
    })
    $("#btn1").click(function () {
        var limg = document.getElementById("licenceimg").value
        if (limg.length == 0) {
            check2 = 1;
        } else {
            check2 = 0;
        }
        if (check == 1 || check1 == 1 || check2 == 1) {
            $('#btn1').prop("disabled", true);
        } else {
            $('#btn1').prop("disabled", false);
        }
    });
});
function fileValidation() {
    var fileInput =
        document.getElementById('licenceimg');

    var filePath = fileInput.value;

    // Allowing file type
    var allowedExtensions =
        /(\.pdf)$/i;

    if (!allowedExtensions.exec(filePath)) {
        $('#btn1').prop("disabled", true);
        alert('Invalid file type');
        fileInput.value = '';
        return false;
    } else {
        $('#btn1').prop("disabled", false);
    }
}