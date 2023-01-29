if(localStorage.getItem('userData') == null){
    location.href="../login.html"

}

const logout = ()=>{
    localStorage.removeItem('userData');
    location.href="../login.html"

}
$("#updateuser").on("submit", function(event){
    event.preventDefault();
    $.ajax({
        type: "PUT",
        url: "http://localhost:8080/profile.php",
        data: JSON.stringify(form),// now data come in this function
        contentType: "application/json; charset=utf-8",
        crossDomain: true,
        dataType: "json",
        success: function (response) {
            alert("successfully updated");
        
        },
        error: function (jqXHR, status) {
            // error handler
            alert('fail' + status.code);
        }
     });
})

