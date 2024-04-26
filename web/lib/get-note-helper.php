<?php

function get_return_value($note, $key): string {
    if ($key == "c_treble") {
        return return_for_treble_c($note);
    } else if ($key == "c_bass") {
        return return_for_bass_c($note);
    } else if ($key == "e_flat") {
        return return_for_e_flat($note);
    } else if ($key == "b_flat") {
        return return_for_b_flat($note);
    }

    return "-1|false|false";
}

function return_for_treble_c($note): string {

    // Make the note work for treble clef in C
    $newNote = $note;
    $noteChanges = 0;

    // Prepare the correct accidental (sharp/flat) to display with the note
    $accidental_notes = [1, 3, 6, 8, 10];
    if (array_search($note % 12, $accidental_notes) > -1) {
        $newNote -= array_search($note % 12, $accidental_notes);
        $accidentals = "|true|false";
    } else {
        $accidentals = "|false|false";

        // Adjust down the note for the accidentals
        while (!is_int(array_search($note % 12, $accidental_notes))) {
            $note++;
            $noteChanges++;
        }
        $newNote -= array_search($note % 12, $accidental_notes);

        // Put $note back to where it was before
        $note -= $noteChanges;
    }

    // Transposition change
    $newNote += 6;

    while ($newNote > 14) {
        $newNote -= 12;
    }

    if ($note < 59 && $note > 48) {
        $newNote -= 12;

        // Adjust for accidentals
        $note += $noteChanges;
        $newNote += array_search($note % 12, $accidental_notes);

        // No idea why this is needed, but it works
        $newNote += 5 - array_search($note % 12, $accidental_notes);

    }

    if ($note > 70 && $note < 75) {
        $newNote += 12;

        // Adjust for accidentals
        $note += $noteChanges;
        $newNote -= array_search($note % 12, $accidental_notes);

        // No idea why this is needed, but it works
        $newNote -= 5 - array_search($note % 12, $accidental_notes);
    }

    return $newNote . $accidentals;

}

function return_for_bass_c($note): string {

    // Make the note work for treble clef in C
    $newNote = $note;
    $noteChanges = 0;

    // Prepare the correct accidental (sharp/flat) to display with the note
    $accidental_notes = [1, 3, 6, 8, 10];
    if (array_search($note % 12, $accidental_notes) > -1) {
        $newNote -= array_search($note % 12, $accidental_notes);
        $accidentals = "|true|false";
    } else {
        $accidentals = "|false|false";

        // Adjust down the note for the accidentals
        while (!is_int(array_search($note % 12, $accidental_notes))) {
            $note++;
            $noteChanges++;
        }
        $newNote -= array_search($note % 12, $accidental_notes);

        // Put $note back to where it was before
        $note -= $noteChanges;
    }

    // Transposition change
    $newNote -= 1;

    $newNote -= 48;

    return $newNote;

    if ($note < 59 && $note > 48) {
        $newNote -= 12;

        // Adjust for accidentals
        $note += $noteChanges;
        $newNote += array_search($note % 12, $accidental_notes);

        // No idea why this is needed, but it works
        $newNote += 5 - array_search($note % 12, $accidental_notes);

    }


    if ($note > 70 && $note < 75) {
        $newNote += 12;

        // Adjust for accidentals
        $note += $noteChanges;
        // $newNote -= array_search($note % 12, $accidental_notes);

        // No idea why this is needed, but it works
//        $newNote -= 5 - array_search($note % 12, $accidental_notes);
    }

    return $newNote . $accidentals;
}