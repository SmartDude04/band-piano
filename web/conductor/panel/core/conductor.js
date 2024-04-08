console.log("Here");
let midi = null;
function onMIDISuccess(midiAccess) {
    console.log("MIDI ready!");
    midi = midiAccess;
}

function onMIDIFailure(msg) {
    console.error(`Failed to get MIDI access - ${msg}`);
}

navigator.requestMIDIAccess().then(onMIDISuccess, onMIDIFailure);