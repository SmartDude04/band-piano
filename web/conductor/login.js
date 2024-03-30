window.onload=function(){
    document.getElementById("pw-field").addEventListener("keyup", function() {
    let nameInput = document.getElementById('pw-field').value;
    if (nameInput !== "") {
        document.getElementById('pw-submit').removeAttribute("disabled");
    } else {
        document.getElementById('pw-submit').setAttribute("disabled", "disabled ");
    }
    });
}