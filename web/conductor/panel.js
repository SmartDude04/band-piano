window.onload = function() {
    document.getElementById("logo").addEventListener("mousemove", imageHover);
    document.getElementById("logo").addEventListener("mouseout", imageRelease);
}

function imageHover(e) {
    let rect = document.getElementById("logo").getBoundingClientRect();
    let centerX = rect.left + (rect.width / 2);
    let centerY = rect.top + (rect.height / 2);

    let amt = 10;
    let diffX = (e.pageX - centerX) / amt;
    let diffY = (e.pageY - centerY) / amt;

    let img = document.getElementById("logo");
    img.style.transform = "scale(1.1) translate(" + diffX + "px, " + diffY + "px)";
}

function imageRelease() {
    document.getElementById("logo").style.transform = "translate(0, 0)";
}