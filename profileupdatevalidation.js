$(document).ready(function () {
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
        $('#imagePreview').hide();
        $('#imagePreview').fadeIn(650);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  $("#imageUpload").change(function () {
    readURL(this);
  });
  var check = 0;
  var check1 = 0;
  var check2 = 0;
  var check3 = 0;
  var check4 = 0;
  var check5 = 0;
  // var check6 = 0;
  // var check7 = 0;

  $("#firstName").keyup(function () {
    var name = document.getElementById("firstName").value
    var c_name = /^[a-z ]{3,20}$/i;
    var r_name = c_name.test(name)
    if (r_name == false) {
      $("#firstName1").text("*Not Valid");
      check = 1;
    } else {
      $("#firstName1").text("");
      check = 0;
      $('#btn').attr("disabled", false);

    }
  })
  $("#userName").keyup(function () {
    var name = document.getElementById("userName").value
    if(name != usr_name){
    var c_name = /^[a-zA-Z]+[_a-zA-Z0-9]{3,20}$/;
    var r_name = c_name.test(name)
    if (r_name == false) {
      $("#userName1").text("*Not Valid");
      check1 = 1;
    } else {
      $.ajax({
        url: 'unamevalidate.php',
        method: "POST",
        data: {
          name: name
        },
        success: function (data) {
          if (data != '0') {
            $('#userName1').html('<span class="text-danger">username Already exist</span>');
          } else {
            check1 = 0;
            $('#btn').attr("disabled", false);
            $("#userName1").text("");
          }
        }
      })

    }
  }else{
    $("#userName1").text("");
  }
  })
  $("#Location").keyup(function () {
    var name = document.getElementById("Location").value
    var c_name = /^[a-zA-Z0-9]+[_a-zA-Z0-9]{3,20}$/;
    var r_name = c_name.test(name)
    if (r_name == false) {
      $("#Location1").text("*Not Valid");
      check2 = 1;
    } else {
      check2 = 0;
      $("#Location1").text("");
      $('#btn').attr("disabled", false);

    }
  })
  $("#emailAddress").keyup(function () {
    var email = document.getElementById("emailAddress").value
    if(email != usr_email){
    var c_email = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
    var r_email = c_email.test(email)
    if (r_email == false) {
      check3 = 1;
      $("#emailAddress1").text("*Enter a valid Email");
    } else {
      $.ajax({
        url: 'emailvalidate.php',
        method: "POST",
        data: {
          email: email
        },
        success: function (data) {
          if (data != '0') {
            $('#emailAddress1').html('<span class="text-danger">Email Already exist</span>');
          } else {
            check3 = 0;
            $('#btn').attr("disabled", false);
            $("#emailAddress1").text("");
          }
        }
      })
    }
  }else{
    $("#emailAddress1").text("");
  }
  })
  $("#phoneNumber").keyup(function () {
    var mobile = document.getElementById("phoneNumber").value
    var c_mobile = /^[6-9][0-9]{9}$/;
    var r_mobile = c_mobile.test(mobile)
    if (r_mobile == false) {
      check4 = 1;
      $("#phoneNumber1").text("*Enter a valid mobile number");
    } else {
      check4 = 0;
      $("#phoneNumber1").text("");
      $('#btn').attr("disabled", false);

    }
  })
  $("#DOB").change(function () {
    var getdate = document.getElementById("DOB").value
    var d = new Date(getdate);
    year = d.getFullYear();
    var fullDate = new Date();
    cyear = fullDate.getFullYear();
    if (cyear - year <= 18) {
      check5 = 1;
      $("#DOB1").text("*You must above 18yrs old");
    } else {
      check5 = 0;
      $('#btn').attr("disabled", false);
      $("#DOB1").text("");
    }

  })
  // $("#Password").keyup(function () {
  //   var pswd = document.getElementById("Password").value
  //   var c_pass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
  //   var r_pass = c_pass.test(pswd);
  //   if (r_pass == false) {
  //     $("#Password1").text("*Enter strong Password");
  //     check6 = 1;
  //   } else {
  //     check6 = 0;
  //     $("#Password1").text("");
  //     $('#btn').attr("disabled", false);
  //   }
  // })
  // $("#Cpassword").keyup(function () {
  //   pswd = document.getElementById("Password").value
  //   cpswd = document.getElementById("Cpassword").value
  //   if (cpswd != pswd) {
  //     $("#Cpassword1").text("Passwords don't match");
  //     check7 = 1;
  //   } else {
  //     check7 = 0;
  //     $("#Cpassword1").text("");
  //     $('#btn').attr("disabled", false);
  //   }
  // })
  $("#btn").click(function () {
    if (check == 1 || check1 == 1 || check2 == 1 || check3 == 1 || check4 == 1 || check5 == 1 ) {
      $('#btn').attr("disabled", true);
    } else {
      $('#btn').attr("disabled", false);
    }
  })
});
function fileValidation() {
  var fileInput =
    document.getElementById('imageUpload');

  var filePath = fileInput.value;

  // Allowing file type
  var allowedExtensions =
    /(\.jpg|\.jpeg|\.png|\.gif)$/i;

  if (!allowedExtensions.exec(filePath)) {
    $('#btn').attr("disabled", true);
    alert('Invalid file type');
    fileInput.value = '';
    return false;
  }
  else {
    $('#btn').attr("disabled", false);
  }
}
