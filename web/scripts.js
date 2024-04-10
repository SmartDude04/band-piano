document.getElementById("main").addEventListener("mousemove", function(event) {
    let mouseX = event.pageX;
    let mouseY = event.pageY;

    let width = event.currentTarget.offsetWidth;
    let height = event.currentTarget.offsetHeight;

    let xOffset = mouseX - width / 2;
    let yOffset = mouseY - height / 2;

    let translateFactor = 24;

    document.getElementById("background").style.transform = `translate(${xOffset / translateFactor}px, ${yOffset / translateFactor}px)`;
});