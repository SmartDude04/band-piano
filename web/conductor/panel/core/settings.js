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

function toastCancel() {

}

function toastDelete() {

}