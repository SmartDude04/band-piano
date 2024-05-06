setInterval(function() {
    let beforeFetch = Date.now();
    fetch("../../lib/latency.php")
        .then(response => response.text())
        .then(response => {
            let curTime = Date.now();
            document.getElementById("latency-num").innerHTML = String(curTime - beforeFetch);
        });
    document.getElementById("latency-num")
}, 1000);

function showToast() {
    // Show the user a toast confirming their intentions
    // This is one of the main use cases of a JS framework: dynamically changing a website based on user responses.
    // In a framework, this is a lot easier (and faster, from a client standpoint) to pull off

    // Grab the toast container and set its visibility to flex
    document.getElementById("toast-container").style.display = "flex";

}

function clearNotes() {
    fetch("../../lib/clear-notes.php")
        .then(response => response.text())
        .then(response => {
            if (response === "true") {

            }
        });


}

function removeToast() {
    // Set the toast container to have a visibility of none
    document.getElementById("toast-container").style.display = "none";
}

function toastDelete() {
    // Send a fetch delete request
    fetch("../../lib/delete-notes.php")
        .then(response => response.text())
        .then(response => {
            if (response === "true") {
                confirmation();
            }
        });
}

function confirmation() {
    // Remove the toast and add the confirmation
    document.getElementById("toast").style.display = "none";
    document.getElementById("confirmation").style.display = "flex";
}

function removeConfirmation() {
    // Remove the confirmation and set items back to normal for another click
    document.getElementById("toast-container").style.display = "none";
    document.getElementById("toast").style.display = "flex";
    document.getElementById("confirmation").style.display = "none";
}