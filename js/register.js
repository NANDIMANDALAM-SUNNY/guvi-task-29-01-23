$("#registerform").on("submit", function(event){
    event.preventDefault();
    const form = {
        fname: document.getElementById('fname').value,
        lname: document.getElementById('lname').value,
        userName: document.getElementById('userName').value,
        email: document.getElementById('email').value,
        password: document.getElementById('password').value,
    }
    $.ajax({
        type: "POST",
        url: "http://localhost:8080/register.php",
        data: JSON.stringify(form),// now data come in this function
        contentType: "application/json; charset=utf-8",
        crossDomain: true,
        dataType: "json",
        success: function (response) {
            alert("successfully registered");
            window.location = "../login.html";
            
        },
        error: function (jqXHR, status) {
            // error handler
            alert('fail' + status.code);
        }
     });
})
