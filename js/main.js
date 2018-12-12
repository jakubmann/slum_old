$('document').ready(function() {

  //registration
  function submitRegisterForm() {
    var data = $('#signup-form').serialize();

    $.ajax({
      type: 'POST',
      url: 'ajax/register.php',
      data: data,
      success: function(data) {
        if (data==1) {
          $('#error').html('<div class="alert">Email already taken!</div>');
        }
        else if (data==2) {
          $('#error').html('<div class="alert">Username already taken!</div>');
        }
        else if (data=='registered') {
          $('#signup-form').html('<div class="alert--success">Registered successfully!</div>');
          setTimeout('window.location.href = "index.php"; ', 4000);
        }
        else {
          $('#error').html('<div class="alert">' + data + '</div>')
        }
      }
    });
  }

  $('#signup-form').validate({
    rules: {
      username: {
        required: true,
        minlength: 3
      },
      firstname: {
        required: true
      },
      lastname: {
        required: true
      },
      password: {
        required: true,
        minlength: 8,
        maxlength: 25
      },
      password_confirm: {
        required: true,
        equalTo: '#password'
      },
      email: {
        required: true,
        email: true
      },
    },
    messages: {
      username: {
        required: 'Please enter a username',
        minlength: 'Username must have at least 3 characters'
      },
      firstname: 'Please enter your first name',
      lastname: 'Please enter your last name',
      password: {
        required: 'Please provide a password',
        minlength: 'Password must have at least 8 characters'
      },
      email: 'Please enter a valid email address',
      password_confirm: {
        required: 'Please confirm your password',
        equalTo: 'Passwords do not match!'
      }
    },
    submitHandler: submitRegisterForm
  });


  //login
  function submitLoginForm() {
    var data = $('#login-form').serialize();

    $.ajax({
      type: 'POST',
      url: 'ajax/login.php',
      data: data,
      success: function(data) {
        if (data == '1') {
          $('.login__input').css('border-color', '#0ed615');
          $('.login__input').css('background-color', '#c3f4c5');
          $('.login__input').css('color', '#0ed615');
          setTimeout('window.location.href = "index.php"; ', 2000);
        }
        else {
          $('login__error').html(data);
        }
        console.log(data);
      }
    });
  }

  $('#login-form').validate({
    rules: {
      username: {
        required: true,
      },
      password: {
        required: true
      }
    },
    messages: {
      password: '',
      username: ''
    },
    submitHandler: submitLoginForm
  });
});



/*
$(document).ready(function() {
  var increase = 2;
  var postCount = 2;

  $(".posts").load("ajax/posts.php", {
    postCount: postCount
  });


  $(".posts__button").click(function() {
    postCount += increase;
    $(".posts").load("ajax/posts.php", {
      postCount: postCount
    });

  });
});
*/
