$("#loginform").on("submit", function(event){
    event.preventDefault();
const form = {
    email : $("email").val(),
    password : $("password").val()
}
    // making request
    $.ajax({
        type: "POST",
        url: "http://localhost:8080/login.php",
        data: JSON.stringify(form),// now data come in this function
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (response) {
            alert("successfully logged in");
            localStorage.setItem('userData',response)
            window.location = "../profile.html";
            
        },
        error: function (jqXHR, status) {
            // error handler
            alert('fail' + status.code);
        }
     });
})