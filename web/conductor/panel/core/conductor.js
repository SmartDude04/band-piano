// Requests MIDI access from the browser
navigator.requestMIDIAccess({ sysex: false }).then(onMIDISuccess, onMIDIFailure);

// Gets called if a MIDI error occurs
function onMIDIFailure(msg) {
    console.error(`Failed to get MIDI access - ${msg}`);
}

// Gets called whe MIDI devices change. Ex: A device is unplugged/plugged in
function updateDevices(event) {
    // console.log(event);
}

// Gets called when a MIDI input device is detected
function onMIDISuccess(midiAccess) {

    midiAccess.addEventListener("statechange", updateDevices);

    const inputs = midiAccess.inputs;

    inputs.forEach((input) => {
        input.onmidimessage = handleInput;
    });
}

function displayNote(note, pressed) {
    let key = document.getElementById("key-" + note);
    let flats = [1, 3, 6, 8, 10];

    if (pressed) {
        // Determine the color to set the note to
        if (flats.includes(note % 12)) {
            key.style.fill = "#2f75ef";
        } else {
            key.style.fill = "#89d7ff";
        }
    } else {
        // Determine the color to put the key back to
        if (flats.includes(note % 12)) {
            key.style.fill = "#000000";
        } else {
            key.style.fill = "#ffffff";
        }
    }
}

function updateLatency(latency) {

}

// Called when a MIDI input is detected
function handleInput(event) {
    let data = event.data;

    // Get data to send to the database
    let note = data[1] + 12;
    let pressed = data[2] !== 0;

    // Make sure the note isn't a slider as that may overwhelm the server
    if (note > 1) {
        fetch(`../../lib/send-note.php?note=${note}&pressed=${pressed}`).then((val) => {
            val.text().then((text) => {
                displayNote(note, pressed);
            });
        });
    }
}

setInterval(() => {
    let currentTime = Date.now();
    fetch("../../lib/ping.php").then((val) => {
        val.text().then((response) => {
            let responseNum = parseFloat(response) * 1000;
            responseNum = parseInt(responseNum.toString());

            updateLatency(responseNum - currentTime);
        })
    })
}, 1000);