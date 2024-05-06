function drawNote(parts) {
    // Draws a note on the screen and removes any old ones. Works for all screen sizes.
    // parts[0] is the note, parts[1] is a control for a flat sign, and parts[2] is a control for a sharp sign


    // Positions: 0 = Bottom Staff
    //      - Each position tick is one note higher.
    //      - Positions CAN go negative if needed.
    //      - If the note is at or above position 4, it will face downwards.

    // Convert position to an int
    let position = parseInt(parts[0]);

    let note = document.getElementById("note");
    let sharp = document.getElementById("sharp");
    let flat = document.getElementById("flat");
    let bar = document.getElementById("bar");
    let bar2 = document.getElementById("bar2");

    if (position === -1) {
        // Remove the note in this case
        note.style.opacity = "0";
        sharp.style.opacity = "0";
        flat.style.opacity = "0";
        bar.style.opacity = "0";
        bar2.style.opacity = "0";
        return;
    } else {
        note.style.opacity = "1";
    }


    // Determine the orientation of the note
    let upwards = position <= 4;

    // Defines the coords to move for each step, starting at point 0
    let positionSteps = [640, 582, 515, 458, 390, 220, 150, 95, 25, -35, -100, -150, -210, -270, -330];
    let flatOffset = upwards ? 190 : 300;
    let sharpOffset = upwards ? 183 : 293;

    // Amounts to use to rotate the note around the correct point
    let rotateYOffset = 400;

    note.setAttribute("y", positionSteps[position].toString());
    if (!upwards) {
        note.setAttribute("transform", `rotate(180, 1175, ${positionSteps[position] + rotateYOffset})`);
    } else {
        note.setAttribute("transform", "");
    }

    // Check if a flat sign is needed
    if(parts[1] === "true") {
        // Display the flat sign next to the note
        flat.style.opacity = "1";
        flat.setAttribute("y", `${positionSteps[position] + flatOffset}`);
    } else {
        // Hide the flat sign
        flat.style.opacity = "0";
    }

    if (parts[2] === "true") {
        // Display the sharp sign next to the note
        sharp.style.opacity = "1";
        sharp.setAttribute("y", `${positionSteps[position] + sharpOffset}`);
    } else {
        // Hide the sharp sign
        sharp.style.opacity = "0";
    }

    // Add a bar for the higher notes
    if (position > 10) {
        bar.style.opacity = "1";

        if (position % 2 === 0) {
            // Bar should be under the note
            bar.setAttribute("y", `${positionSteps[position] + 510}`);
        } else {
            bar.setAttribute("y", `${positionSteps[position] + 450}`);
        }

        if (position > 12) {
            bar2.style.opacity = "1";
            // Add the second bar
            if (position % 2 === 0) {
                // Bar should be under the note
                bar2.setAttribute("y", `${positionSteps[position] + 630}`);
            } else {
                bar2.setAttribute("y", `${positionSteps[position] + 570}`);
            }
        }
    } else {
        // Remove the bar
        bar.style.opacity = "0";
        bar2.style.opacity = "0";
    }
}

setInterval(function() {
    fetch("../lib/get-note.php")
        .then(response => response.text())
        .then(response => {
            console.log(response);
            drawNote(response.split("|"));
        });
}, 250);