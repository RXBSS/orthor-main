<?php


function getExampleForm($id, $withData = false) {

    // String
    $testform = '
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label">Static Text</label>
                <input type="text" class="form-control editable" name="stext" value="' . (($withData) ? "Harry Potter" : "") . '" required />
            </div>

            <div class="form-group">
                <label class="form-label">Static E-Mail</label>
                <input type="email" class="form-control editable" name="semail" value="' . (($withData) ? "harry.potter@web.de" : "") . '" required />
            </div>

            <div class="form-group">
                <label class="form-label">Static Password</label>
                <input type="password" class="form-control editable" name="spassword" value="' . (($withData) ? "WandFight23" : "") . '" />
            </div>

            <div class="form-group">
                <label class="form-label">Static Date</label>
                <input type="date" class="form-control editable" name="sdate" value="' . (($withData) ? "1980-07-31" : "") . '" required />
            </div>

            <div class="form-group">
                <label class="form-label">Static Time</label>
                <input type="time" class="form-control editable" name="stime" value="' . (($withData) ? "09:50" : "") . '" />
            </div>

            <div class="form-group">
                <label class="form-label">Static Select</label>
                <select class="form-select editable" name="sselect" placeholder="Floating Select">
                    <option value="">Bitte wählen</option>
                    <option value="1">Wert 1</option>
                    <option value="2" ' . (($withData) ? "selected" : "") . '>Wert 2</option>
                    <option value="3">Wert 3</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Static Select</label>
                <select class="form-select editable" name="sselectmulti" placeholder="Floating Select" multiple>
                    <option value="">Bitte wählen</option>
                    <option value="1">Wert 1</option>
                    <option value="2" ' . (($withData) ? "selected" : "") . '>Wert 2</option>
                    <option value="3">Wert 3</option>
                    <option value="4" ' . (($withData) ? "selected" : "") . '>Wert 4</option>
                    <option value="5" ' . (($withData) ? "selected" : "") . '>Wert 5</option>
                    <option value="6">Wert 6</option>
                    <option value="7">Wert 7</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Static Label</label>
                <textarea class="form-control editable" name="stextarea" placeholder="Static Textarea">' . (($withData) ? "i solemnly swear that i am up to no good" : "") . '</textarea>
            </div>
        </div>
        <div class="col-md-3">

            <div class="form-floating form-group">
                <input type="text" name="ftext" class="form-control editable" placeholder="Floating Text" value="' . (($withData) ? "Ron Weasley" : "") . '">
                <label>Floating Text</label>
            </div>

            <div class="form-floating form-group">
                <input type="email" name="femail" class="form-control editable" placeholder="Floating Mail">
                <label>Floating E-Mail</label>
            </div>

            <div class="form-floating form-group">
                <input type="password" name="fpassword" class="form-control editable" placeholder="Floating Password">
                <label>Floating Password</label>
            </div>

            <div class="form-floating form-group">
                <input type="date" name="fdate" class="form-control editable" placeholder="Floating Date">
                <label>Floating Date</label>
            </div>

            <div class="form-floating form-group">
                <input type="time" name="ftime" class="form-control editable" placeholder="Floating Time" >
                <label>Floating Time</label>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group form-floating">
                        <input type="text" name="betrag" class="form-control editable" data-format="betrag" data-unit="<i class=\'fas fa-euro-sign\'></i>" placeholder="Bezeichnung" value="' . (($withData) ? "500000000000000000000000" : "") . '" required>
                        <label>Betrag</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group form-floating">
                        <input type="text" name="meter" class="form-control editable" data-unit="Meter" placeholder="Bezeichnung" value="' . (($withData) ? "20" : "") . '" required>
                        <label>Länge</label>
                    </div>
                </div>
            </div>

            <div class="form-floating form-group">
                <select class="form-select editable" name="fselect" placeholder="Floating Select" required>
                    <option value="">Bitte wählen</option>
                    <option value="1">Wert 1</option>
                    <option value="2">Wert 2</option>
                    <option value="3">Wert 3</option>
                    <option value="4">Wert 4</option>
                    <option value="5">Wert 5</option>
                    <option value="6">Wert 6</option>
                </select>
                <label>Select</label>
            </div>          

            <div class="form-floating form-group">
                <select class="form-select editable" name="fselectmulti" placeholder="Floating Select" multiple>
                    <option value="1">Wert 1</option>
                    <option value="2" ' . (($withData) ? "selected" : "") . '>Wert 2</option>
                    <option value="3">Wert 3</option>
                    <option value="4" ' . (($withData) ? "selected" : "") . '>Wert 4</option>
                    <option value="5" ' . (($withData) ? "selected" : "") . '>Wert 5</option>
                    <option value="6">Wert 6</option>
                    <option value="7">Wert 7</option>
                </select>
                <label>Floating Select</label>
            </div>

            <div class="form-floating form-group">
                <textarea class="form-control editable" name="ftextarea" placeholder="Floating Textarea" required></textarea>
                <label>Floating Textarea</label>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label">Mehrfachauswahl / Linebreak</label>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input editable" id="cb-' . $id . '-1-1" name="cbmehrfach[]" value="1" />
                    <label class="form-check-label" for="cb-' . $id . '-1-1">Wert 1</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input editable" id="cb-' . $id . '-1-2" name="cbmehrfach[]" value="2" ' . (($withData) ? "checked" : "") . ' />
                    <label class="form-check-label" for="cb-' . $id . '-1-2">Wert 2</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input editable" id="cb-' . $id . '-1-3" name="cbmehrfach[]" value="3" ' . (($withData) ? "checked" : "") . ' />
                    <label class="form-check-label" for="cb-' . $id . '-1-3">Wert 3</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input editable" id="cb-' . $id . '-1-4" name="cbmehrfach[]" value="4" />
                    <label class="form-check-label" for="cb-' . $id . '-1-4">Wert 4</label>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Einfach Auswahl</label>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input editable" id="cb-' . $id . '-2-1" name="cbeinfach" value="1" ' . (($withData) ? "checked" : "") . ' />
                    <label class="form-check-label" for="cb-' . $id . '-2-1">Wert 1</label>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Checkbox Inline</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input editable" type="checkbox" id="cb-' . $id . '-3-1" name="cbmehrfachinline[]" value="option1">
                    <label class="form-check-label" for="cb-' . $id . '-3-1">Wert 1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input editable" type="checkbox" id="cb-' . $id . '-3-2" name="cbmehrfachinline[]" value="option2" ' . (($withData) ? "checked" : "") . '>
                    <label class="form-check-label" for="cb-' . $id . '-3-2">Wert 1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input editable" type="checkbox" id="cb-' . $id . '-3-3" name="cbmehrfachinline[]" value="option3" ' . (($withData) ? "checked" : "") . ' disabled>
                    <label class="form-check-label" for="cb-' . $id . '-3-3">Wert 3</label>
                </div>
            </div>


            <div class="form-group">
                <label class="form-label">Radio Linebreak</label>
                <div class="form-radio">
                    <input type="radio" class="form-check-input editable" id="cb-' . $id . '-4-1" name="cbradioline" value="1" />
                    <label class="form-check-label" for="cb-' . $id . '-4-1">Wert 1</label>
                </div>
                <div class="form-radio">
                    <input type="radio" class="form-check-input editable" id="cb-' . $id . '-4-2" name="cbradioline" value="2" ' . (($withData) ? "checked" : "") . ' />
                    <label class="form-check-label" for="cb-' . $id . '-4-2">Wert 2</label>
                </div>
                <div class="form-radio">
                    <input type="radio" class="form-check-input editable" id="cb-' . $id . '-4-3" name="cbradioline" value="3" />
                    <label class="form-check-label" for="cb-' . $id . '-4-3">Wert 3</label>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Radio Inline</label><br>
                <div class="form-radio form-check-inline">
                    <input class="form-check-input editable" type="radio" id="cb-' . $id . '-5-1" name="cbradioinline" value="option1">
                    <label class="form-check-label" for="cb-' . $id . '-5-1">Wert 1</label>
                </div>
                <div class="form-radio form-check-inline">
                    <input class="form-check-input editable" type="radio" id="cb-' . $id . '-5-2" name="cbradioinline" value="option2">
                    <label class="form-check-label" for="cb-' . $id . '-5-2">Wert 1</label>
                </div>
                <div class="form-radio form-check-inline">
                    <input class="form-check-input" type="radio" id="cb-' . $id . '-5-3" name="cbradioinline" value="option3" disabled>
                    <label class="form-check-label" for="cb-' . $id . '-5-3">Wert 3</label>
                </div>
            </div>

            <div class="form-group form-check form-switch">
                <label class="form-label">Switch Label</label><br>
                <input class="form-check-input editable" name="cbswitch" type="checkbox" id="cb-' . $id . '-6-1" ' . (($withData) ? "checked" : "") . '>
                <label class="form-check-label" for="cb-' . $id . '-6-1">Switch Example</label>
            </div>

            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                <input type="checkbox" class="btn-check editable" name="checkedbutton1" id="cb-' . $id . '-7-1" autocomplete="off">
                <label class="btn btn-outline-primary" for="cb-' . $id . '-7-1">Wert 1</label>
                <input type="checkbox" class="btn-check editable" name="checkedbutton2" id="cb-' . $id . '-7-2" autocomplete="off">
                <label class="btn btn-outline-primary" for="cb-' . $id . '-7-2">Wert 2</label>
                <input type="checkbox" class="btn-check editable" name="checkedbutton3" id="cb-' . $id . '-7-3" autocomplete="off">
                <label class="btn btn-outline-primary" for="cb-' . $id . '-7-3">Wert 3</label>
            </div>

            <br>
            <br>

            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check editable" name="radiobutton" id="cb-' . $id . '-8-1" value="1" autocomplete="off">
                <label class="btn btn-outline-primary" for="cb-' . $id . '-8-1">Wert 1</label>
                <input type="radio" class="btn-check editable" name="radiobutton" id="cb-' . $id . '-8-2" value="2" autocomplete="off">
                <label class="btn btn-outline-primary" for="cb-' . $id . '-8-2">Wert 2</label>
                <input type="radio" class="btn-check editable" name="radiobutton" id="cb-' . $id . '-8-3" value="3" autocomplete="off">
                <label class="btn btn-outline-primary" for="cb-' . $id . '-8-3">Wert 3</label>
            </div>

        </div>
        <div class="col-md-3">
            <div class="form-group form-range">
                <label for="range-' . $id . '-1" class="form-label">Beispiel Range</label>
                <input type="range" name="range"  class="form-range editable" id="range-' . $id . '-1" min="1" max="100" value="50">
            </div>
            <div class="form-group">
                <label class="form-label">Standard Select 2</label><br>
                <select class="form-select editable init-select2" name="select21" required>
                    <option value="" selected>bitte wählen</option>
                    <option value="1">Wert 1</option>
                    <option value="2">Wert 2</option>
                    <option value="3">Wert 3</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Noch ein Select 2</label><br>
                <select class="form-select editable init-select2" name="select22" required>
                    <option value="" selected>bitte wählen</option>
                    <option value="1">Wert 1</option>
                    <option value="2">Wert 2</option>
                    <option value="3">Wert 3</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Multiple Select 2</label><br>
                <select class="form-select editable init-select2" name="select2multi" multiple="multiple">
                    <option value="1">Mein etwas längerer Wert</option>
                    <option value="2">Noch ein etwas längerer Wert</option>
                    <option value="3">Mehr längere Werte</option>
                    <option value="4">Wert 4</option>
                    <option value="5">Wert 5</option>
                </select>
            </div>           
            <div class="form-group">
                <label class="form-label">Input File</label><br>
                <input class="form-control editable" name="file" type="file" >
            </div>


            <strong>Quickselect</strong>
           
            <div class="form-group">
                <label class="form-label">Benutzer</label><br>
                <select class="form-select editable init-quickselect" name="quickselect2" data-qs-name="user" data-qs-default-text="Mein Default Text" data-qs-default-value="999" required>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Länder (Multiple)</label><br>
                <select class="form-select editable init-quickselect" name="quickselect" data-qs-name="laender" multiple="multiple" required>
                </select>
            </div>
            

        
            <strong>Summernote</strong>
            <textarea name="summernote" class="summernote editable" cols="20" rows="10">' . (($withData) ? "Hier steht etwas drin!" : "") . '</textarea>

            <br>

            <p><strong>Zusätzliche Daten</strong></p>
            <div class="additional-data" style="background: blue;width: 100%;height:40px;">

            </div>

        </div>
    </div>';

    return $testform;
}
