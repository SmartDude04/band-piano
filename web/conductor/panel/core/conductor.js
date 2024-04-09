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

// Called when a MIDI input is detected
function handleInput(event) {
    let data = event.data;

    // Get data to send to the database
    let note = data[1];
    let pressed = data[2] !== 0;

    fetch(`../../lib/send-note.php?note=${note}&pressed=${pressed}`).then((val) => {
        val.text().then((text) => {
            console.log(text);
        })
    });
}