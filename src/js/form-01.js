/**
 * Form Klasse
 * ---
 * 
 * Diese Klasse stellt alle Form Funktionen zur Verfügung. 
 * Mit Ihr kann man zum Beispiel Form-Validation aktivieren. 
 * 
 * Außerdem gibt es Extra Klassen für Modal und Cards
 * Dabei werden zusätzliche Funktionen und GUI-Elemente hinzugefügt
 * 
 * In einer Form müssen die Namen eindeutig sein. Es dürfen keine zwei Felder die gleichen Namen haben.
 * 
 * 
 */




/**
 * #Standard Form Klasse
 * Mit dieser Klasse kann man das Auslesen, Bearbeiten usw. von Forms vereinfachen. 
 * 
 * @class Form
 * @param {String} container Name des Selectors z.B. `#form` oder `.custom form`
 * @param {Boolean} [debug=false] Wenn ein Log erstellt werden soll
 * 
 */
var Form = class {

	// Constructor
	constructor(container, opts) {

		var me = this;

		// Wenn keine Optionen mit angegeben wurden
		opts = opts || {};

		// Initale Werte festlegen
		me.name = container;
		me.container = $(container);
		me.form = me.container;

		// Für Select 2 Fehler
		me.globalNoRevalidation = false;

		// Optionen mergen
		me.options = $.extend({
			debug: false,
			cardContainer: false
		}, opts);

		// Default initalisieren
		me.init();
	}

	/**
	 * Init Funktion
	 */
	init() {

		var me = this;


		// Default initalisieren
		me.initDefault();

		me.container.trigger('initComplete');
	}


	/**
	 * Alles was initalisiert werden soll.
	 * Diese Funktion wird auch bei allen unterklassen aufgerufen
	 *  
	 */
	initDefault() {

		var me = this;

		me.log('Init Default');

		// Prüfen ob der Cotainer exisitert
		if (me.container.length) {

			// Init
			me.fvInstanz = false;

			// Current Saving
			me.isSaving = false;

			// Felder festlegen, die ausgelesen und damit unterstützt werden!
			me.fields = [
				'input[type="text"]',
				'input[type="search"]',
				'input[type="password"]',
				'input[type="hidden"]',
				'input[type="email"]',
				'input[type="date"]',
				'input[type="time"]',
				'input[type="file"]',
				'input[type="range"]',
				'input[type="checkbox"]',
				'input[type="radio"]',
				'input[type="number"]',
				'select',
				'textarea'
			];

			// Prüfen, dass eine Sub-Form auch eine ID hat
			if (me.form.hasClass('sub-form') && !me.form.attr('id')) {
				throw new Error("Eine Sub-Form muss immer eine ID vergeben haben!");
			}

			// Abspeichern des aktuellen Zustands
			me.initFormData = me.getData();

			me.isReadonly = false;
			me.hasValidation = false;

			// Alle Select2 initalisieren
			me.initSelect2();

			// Alle Select2 initalisieren
			me.initQuickselect();

			// Init Units
			me.initUnits();

			// Init Format
			me.initFormat();

			// Init Summernote
			me.initSummernote();

			// Add Default Event Listeners
			me.addEventListner();

		} else {
			console.warn('Container nicht gefunden');
		}
	}

	/**
	 * Sucht nach allen Select2 in der Form die automatisch initalisiert werden sollen
	 * Das biete eine kleine Hilfe, dass man diese nicht manuell initalisieren muss. 
	 * Für komplexere Select2 sollte man aber auf jeden Fall selber initalisieren. 
	 * 
	 * Die Select 2 müssen dazu eine Klasse namens `init-select2` haben. Diese wird im Anschluss direkt ersetzt
	 * 
	 */
	initSelect2() {

		var me = this;

		me.log('Init Select 2');

		// Durch alle Select2 loopen
		me.form.find('.init-select2').each(function () {

			var el = $(this);

			if (me.belongsToForm(el)) {

				// Select 2 
				el.select2({
					dropdownParent: me.container,
					dropdownAutoWidth: true,
					width: '100%',
				}).on('change', function () {

					// Wenn FormValidation aktiv ist, dann muss hier revalidiert werden
					if (me.fvInstanz) {

						var fields = me.fvInstanz.getFields();
						var name = el.attr('name');

						// Neu Validieren
						if (typeof fields[name] != 'undefined' && me.globalNoRevalidation === false) {
							me.fvInstanz.revalidateField(name);
						}
					}
				});

				// Remove init Class und füge die Standard Klasse hinzu
				el.removeClass('init-select2');
			}
		});
	}

	initQuickselect() {

		var me = this;

		me.log('Init Quickselect');

		// Quickselect Objekt initalisieren
		me.qs = {};

		// Quickselect initalisieren
		me.form.find('.init-quickselect').each(function () {

			// Elements
			var el = $(this);

			if (me.belongsToForm(el)) {

				var name = el.attr('name');
				var qsName = (typeof el.data('qs-name') == "undefined") ? name : el.data('qs-name');
				var onlyId = (el.data('qs-only-id') === true) ? true : false;
				var closeOnSelect = (el.data('qs-close-on-select') === false || el.prop('multiple') == true) ? false : true;
				var debug = (el.data('qs-debug') === true) ? true : false;

				// Wenn es keine Config Datei gibt
				var table = (typeof el.data('qs-table') == "undefined") ? false : el.data('qs-table');
				var fields = (typeof el.data('qs-fields') == "undefined") ? false : el.data('qs-fields');
				var primary = (typeof el.data('qs-primary') == "undefined") ? false : el.data('qs-primary');
				var schema = (typeof el.data('qs-schema') == "undefined") ? false : el.data('qs-schema');

				// Quickselect initalisieren
				me.qs[name] = new Quickselect(qsName, {
					selector: el.get(0),
					dropdownParent: me.form,
					defaultText: el.data('qs-default-text'),
					defaultValue: el.data('qs-default-value'),
					onlyId: onlyId,
					closeOnSelect: closeOnSelect,
					debug: debug,
					table: table,
					fields: fields,
					primary: primary,
					schema: schema
				});

				me.qs[name].on('change', function () {

					// Wenn FormValidation aktiv ist, dann muss hier revalidiert werden
					if (me.fvInstanz) {

						var fields = me.fvInstanz.getFields();

						// Neu Validieren
						if (typeof fields[name] != 'undefined' && me.globalNoRevalidation === false) {
							me.fvInstanz.revalidateField(name);
						}
					}
				});
			}
		});
	}

	// Init Summernote
	initSummernote() {

		var me = this;

		me.log('Init Summernote');

		// Wenn es sich um einen Input handelt
		me.container.find('textarea').each(function () {

			// Element
			var el = $(this);

			// Gehört dieses Element überhaupt zur Form?
			if (me.belongsToForm(el)) {

				//  Prüfen ob es ein Summernote ist
				if (me.isSummernoteEl(el)) {

					// Name
					var name = el.attr('name');

					el.on('summernote.change', function (customEvent, contents, $editable) {

						// Wenn FormValidation aktiv ist, dann muss hier revalidiert werden
						if (me.fvInstanz) {

							var fields = me.fvInstanz.getFields();

							// Neu Validieren
							if (typeof fields[name] != 'undefined' && me.globalNoRevalidation === false) {
								me.fvInstanz.revalidateField(name);
							}
						}
					});
				}
			}
		});
	}


	// 
	renewInitFormData() {
		var me = this;
		me.initFormData = me.getData();
	}

	// Alle mit Units
	initUnits() {

		var me = this;

		me.container.find('[data-unit]').each(function () {

			var el = $(this);

			if (me.belongsToForm(el)) {

				el.after('<div class="form-unit">' + el.data('unit') + '</div>');

				me.resizeUnitElement(el);

				el.on('change keyup', function () {
					me.resizeUnitElement($(this));
				});

			}
		});


		me.container.find('[data-unitaction]').each(function () {

			var el = $(this);

			if (me.belongsToForm(el)) {
				el.parent().find('.form-unit').on('click', function () {

					var value = el.val();


					// Action
					var action = el.data('unitaction');

					// Default Events
					if (action == 'call') {
						window.location = "tel:" + value;
					} else if (action == 'mail') {
						window.location = "mailto:" + value;
					} else if (action == 'link') {
						window.open(value);
					} else if (action == 'copy') {
						// TODO: Muss noch gemacht werden
						app.notify.error.fire("Fehler", "In die Zwischenablage kopieren wurde noch nicht programmiert");
					} else {
						$('body').trigger('unitaction', [action, value]);
						me.container.trigger('unitaction', [action, value]);

						$('body').trigger('action-' + action, [value]);
						me.container.trigger('action-' + action, [value]);

					}
				});
			}
		});
	}


	// 
	resizeUnitElement(el) {

		var me = this;

		if (me.belongsToForm(el)) {

			var size = el.parent().find(".form-unit").width() + 2;

			if (el.hasClass('is-valid') || el.hasClass('is-invalid')) {
				el.css({ 'padding-right': size + 20 });

			} else {
				el.css({ 'padding-right': size });
			}

		}
	}


	resizeUnitAll() {
		var me = this;
		me.container.find('[data-unit]').each(function () {
			me.resizeUnitElement($(this));
		});
	}

	// Format
	initFormat() {

		var me = this;

		// Format 
		me.container.find('[data-format]').each(function () {

			var el = $(this);

			if (me.belongsToForm(el)) {

				// Event Listner
				el.on('focusout', function () {

					// Revalidierung
					if (!me.globalNoRevalidation && me.fvInstanz) {

						// Felder auslesen
						var validationFields = me.fvInstanz.getFields();

						// Neu Validieren
						if (typeof validationFields[el.attr('name')] != 'undefined') {
							me.fvInstanz.revalidateField(el.attr('name'));
						}
					}
				});
			}
		});
	}


	/*

	formatField(el, noRevalidate) {


		var me = this;
		var value = el.val();
		var formatter = el.data('format');

		var rework = false;

		switch(formatter) {
			case "betrag":
	
				if(value) {

					rework = true;

					var asFloat = app.parseGermanNumber(value);

					
					if(!isNaN(asFloat)) {

						value = new Intl.NumberFormat('de-DE', {
							minimumFractionDigits: 2,
							maximumFractionDigits: 8
						}).format(asFloat);

					} else {
						value = "";
					}
				}

				break;
		}

		if(rework) {
			el.val(value);

			if(!me.globalNoRevalidation && me.fvInstanz) {
			
				var validationFields = me.fvInstanz.getFields();

				// Neu Validieren
				if(typeof validationFields[el.attr('name')] != 'undefined') {
					me.fvInstanz.revalidateField(el.attr('name'));
				}
			}

		}

	}

	*/



	load(task, file, data, callbackSuccess, callbackError) {

		var me = this;

		// Loader
		//app.notify.loader.fire();

		// Read Only setzen
		me.setReadonly(true);

		// Default Loading
		me.defaultLoad(task, file, data, callbackSuccess, callbackError);
	}

	/**
	 * Standard Ladeabfrage
	 * 
	 * Wenn keine Daten gesammelt werden konnten, sollte sich die Form nicht entsperren
	 * 
	 * 
	 */
	defaultLoad(task, file, data, callbackSuccess, callbackError) {

		var me = this;

		// Initalisieren
		callbackSuccess = callbackSuccess || false;
		callbackError = callbackError || false;

		// Ajax Abfrage
		$.ajax({
			type: 'POST',
			url: file,
			dataType: 'json',
			data: {
				task: task,
				data: data
			},

			// Success Callback
			success: function (data) {

				// Wenn alles geklappt hat
				if (data.success && data.data) {

					// Wenn alles geklappt hat
					me.setData(data.data, true, true);

					// Laden Fertig
					me.loadFinished();

					// Callback ausführen
					if (typeof callbackSuccess == 'function') {
						callbackSuccess(data);
					}

					// Wenn nicht Success zurückgegeben wurde
				} else {

					// Wenn ein Fehler aufgetreten ist 
					if (typeof callbackError == 'function') {
						callbackError(data);
					} else {

						if (data.success) {
							console.warn("Es wurde zwar Success, aber keine Daten mit zurückgegeben!");
							console.log(data);
						} else {
							console.warn("No Success Data from Handle Skript");
							console.log(data);
							app.alert.error.fire("Fehler", "Es ist ein Fehler bei der Kommunikation mit dem Server aufgetreten!");
						}
					}
				}
			},

			// Error Callback
			error: function (jqXHR, textStatus, errorThrown) {

				// Callback ausführen
				if (typeof callbackError == 'function') {
					callbackError({
						success: false,
						error: jqXHR,
						data: [jqXHR, textStatus, errorThrown]
					});
				} else {
					// Console Meldung ausgeben
					console.warn('Fehler beim Laden', jqXHR, textStatus, errorThrown);

					// Debug Error
					app.alert.debugError('Fehler beim Laden', errorThrown, jqXHR.responseText);
				}
			}
		});
	}

	loadFinished() {

		var me = this;

		// Loader schließen
		//app.notify.loader.close();

		me.container.trigger('load');

		// Readonly wieder entsperren
		me.setReadonly(false);

	}


	addEventListner() {

		var me = this;

		me.defaultAddEventListener();
	}


	/**
	 * Event Listener
	 * - Submit Event
	 * 
	 * 
	 */
	defaultAddEventListener() {

		var me = this;

		me.log('Add Default Event Listners');

		// Sorgt dafür, dass das Standard Verhalten nicht mehr greift
		me.form.on('submit', function (e) {
			e.preventDefault();
		});

		me.form.on('reset', function (e) {
			e.preventDefault();
		});

		// Fix für #17 Blurred automatisch bei Fokus auf ein Readonly Input
		me.container.on('focus', 'input, textarea', function () {
			if ($(this).prop('readonly')) {
				$(this).blur();
			}
		});

		// Speichern Button
		me.container.on('click', '.btn-form-save', function (e) {
			if (me.belongsToForm($(this))) {
				me.submit();
			}
		});

		// Event Listner für Revalidate
		// -----------------------------------

		// Für alle Felder
		$.each(me.getFields(), function () {

			// Erneut Validieren
			$(this).on('revalidate', function () {

				// Nur wenn die Validierung aktiv ist und das Feld zu Validieren ist
				if (me.fvInstanz && me.inValidationList($(this).attr('name'))) {
					me.fvInstanz.revalidateField($(this).attr('name'));
				}
			});
		});



	}

	/**
	 * Event Listner
	 * 
	 */
	on(event, cb) {
		var me = this;
		me.container.on(event, cb);
	}

	/**
	 * Perform Submit
	 */
	submit() {

		var me = this;

		me.log('Submit');

		if (!me.fvInstanz) {
			me.form.submit();
		}
	}

	/**
	 * Setzt alle Felder in einer Form auf Readonly. Dabei werden allerdings nur Felder beachtet die die Klasse 'editable' haben. 
	 * Sonst könnte man keine Felder mehr generell ausgrauen.
	 * 
	 * Diese Funktion feuert außerdem das Event 'onSetReadonly'
	 *
	 * @param {Boolean} setReadonly 'true' für Ja und 'false' für Nein
	 */
	setReadonly(setReadonly) {

		var me = this;

		me.isReadonly = setReadonly;

		var fields = me.getFields();

		// Für alle Felder
		$.each(fields, function () {

			// Wenn es ein Objekt ist, das gesteuert werden soll
			if ($(this).hasClass('editable')) {
				me.setFieldReadonly($(this), setReadonly)
			}
		});

		// Event Feuern
		me.container.trigger('readonly', [setReadonly]);

	}




	/**
	 * Sucht das Feld anhand des Namens in einer Form
	 * @param {String} name Der Name des Feldes
	 * @return {jQuery} Gibt das Element als jQuery zurück
	 */
	getField(name) {

		var me = this;
		var fields = me.getFields();

		var found = false;

		$.each(fields, function (index, el) {
			if (el.attr('name') == name) {
				found = el;
				return false;
			}
		});

		// Element zurückgeben
		return found;
	}


	/**
	 * Get Element
	 */
	getEl(name) {
		var me = this;
		return me.getField(name);
	}

	/**
	 * Setzt eine bestimmtes Feld readonly
	 * @param {jQuery|String} el Hier kann der Name (Funktion {@link #getField}) oder ein jQuery Element übergeben werden
	 * @param {Boolean} setReadonly true = readonly setzen oder false = readonly entfernen
	 *  
	 */
	setFieldReadonly(el, setReadonly) {

		var me = this;

		// Element Normalisieren
		el = (el instanceof jQuery) ? el : me.getField(el);

		// Prüfen ob das Element exsitiert
		if (el) {

			//
			var tagName = el.prop("tagName").toLowerCase();
			var type = el.attr('type');

			if (tagName == 'select' || (tagName == 'input' && (type == 'checkbox' || type == 'radio' || type == 'file' || type == 'range'))) {

				// Setze Selects auf Disabled
				el.prop('disabled', setReadonly);

				// Wenn es Quick Action Buttons gibt
				if (tagName == 'select' && el.closest('.qs-buttons').length) {
					el.closest('.qs-buttons').find('[data-action]').prop('disabled', setReadonly);
				}

			} else {

				// Wenn es sich um ein Sumemrnote Element handelt
				if (me.isSummernoteEl(el)) {

					// Summernote aktiviere oder deaktivieren
					el.summernote((setReadonly) ? 'disable' : 'enable');

				} else {
					// Setze Inputs auf Read Only
					el.prop('readonly', setReadonly);
				}
			}
		}
	}

	/**
	 * Prüfen ob es sich bei dem Element um ein Summernote Objekt handelt
	 * @param {jQuery} el Das jQuery Element das geprüft werden soll
	 * @returns {Boolean} Gibt true oder false zurück
	 */
	isSummernoteEl(el) {
		return (el.parent().find('.note-editor').length > 0) ? true : false;
	}


	/**
	 * Prüft ob ein Feld in der Liste der zu Validierenden Felder ist
	 * Gibt immer `false` zurück, falls Form Validation garnicht aktiv ist
	 * 
	 * 
	 * @param {String} name Name des Feldes das geprüft werden soll
	 * @returns {Boolean} Gibt `true` zurück, wenn das Feld gefunden wurde, ansonsten `false`
	 *  
	 */
	inValidationList(name) {

		var me = this;

		var result = false;

		// Prüfen ob Form Validation aktiv ist
		if (me.fvInstanz) {

			// Alle Felder auslesen
			var fields = me.fvInstanz.getFields();

			if (typeof fields[name] != 'undefined') {
				result = true;
			}
		}

		return result;
	}



	/**
	 * Siehe {@link defaultSave}
	 */
	save(task, handler, cbSuccess, cbError, additional) {

		var me = this;
		me.defaultSave(task, handler, cbSuccess, cbError, additional);
	}

	/**
	 * 
	 * Speichern Der Form
	 * 
	 * @param {String} task Aufgabe die an PHP übergeben wird
	 * @param {String} handler PHP Datei die im `assets/ajax/` Pfad gesucht wird
	 * @param {Function|Boolean} [cbSuccess=false] Führt die Funktion aus die man übergibt oder bei Boolean `true` wird die Standard-Aktion und bei `false` wird gar nichts ausgeführt
	 * @param {Function|Boolean} [cbError=false] Führt die Funktion aus die man übergibt oder bei Boolean `true` wird die Standard-Aktion und bei `false` wird gar nichts ausgeführt
	 * @param {Object} [additional={}] Zusätzliche Key -> Value Paare als Daten die übergeben werden können
	 */
	defaultSave(task, handler, cbSuccess, cbError, additional) {

		var me = this;

		// Log
		me.log('Default Save');

		if (!me.isSaving) {

			me.isSaving = true;

			// Alle Submit Buttons deaktivieren
			$.each(me.getSubmitButtons(), function () {
				$(this).prop('disabled', true);
			});

			// Input
			cbSuccess = cbSuccess || false;
			cbError = cbError || false;

			// Zusätzliche Daten in ein Objekt übernehmen
			var additionalData = (additional && typeof additional == 'object') ? additional : {};

			// Get Current Values
			var formData = me.getData();

			// Compare Current Values with init Values
			var compareData = me.compareData();

			// Generate Post Data
			var postData = {
				task: task,
				formData: formData,
				compareData: compareData,
				additional: additionalData
			};

			// Speichern ausführen
			me.saving();

			me.log('Start Ajax');

			// Speichern 
			$.ajax({
				type: "POST",

				// TODO: URL noch aus Config?
				url: handler,
				dataType: 'json',
				data: postData,
				success: function (data) {

					me.log('Ajax Complete');

					// Loader schließen
					//app.notify.loader.close();

					// Wenn es ein Success 
					if (data.success) {

						// Init Form Data überschreiben
						me.initFormData = formData;

						// Success Callback ausführen
						if (typeof cbSuccess == 'function') {

							// Callback auswerten
							var result = cbSuccess(data);

							// Wenn es einen Return Wert vom Callback gibt
							if (result) {
								app.notify.success.fire("Erfolgreich!", (result === true) ? ((data.message) ? data.message : "Das Formular wurde erfolgreich gespeichert.") : result);
							}

							// Wenn der Standard Callback geschickt werden soll 
						} else {
							app.notify.success.fire("Erfolgreich!", (data.message) ? data.message : "Das Formular wurde erfolgreich gespeichert.");
						}

						// Result übergeben
						me.saved(false);


						// Ist es nicht erfolgreich gewesen
					} else {

						// Wenn es einen Custom Error gibt
						if (typeof cbError == 'function') {

							// Callback auswerten
							var result = cbError('custom', data);

							// Wenn es ein Ergebnis zurück gibt
							if (result) {
								app.notify.error.fire("Fehler beim Speichern!", (result === true) ? ((data.error) ? data.error : "Das Formular wurde nicht vollständig gespeichert.") : result);
							}

							// Wenn die Standard Fehlermeldung gesendert werden soll
						} else {
							app.notify.error.fire("Fehler beim Speichern!", (data.error) ? data.error : "Das Formular wurde nicht vollständig gespeichert.");
						}

						// Result übergeben
						me.saved(true);
					}
				},

				// 
				error: function (jqXHR, textStatus, errorThrown) {

					console.warn('Fehler beim Speichern', jqXHR, textStatus, errorThrown);

					// Saved with Error
					me.saved(true);

					// 
					if (typeof cbError == 'function') {

						var result = cbError('ajax', jqXHR.responseText);

						if (result) {

							// Debug Error
							app.alert.debugError('Fehler beim Speichern', errorThrown, jqXHR.responseText);
						}

					} else {

						// Debug Error
						app.alert.debugError('Fehler beim Speichern', errorThrown, jqXHR.responseText);
					}
				}
			});

			// Wenn man noch eine Meldung einbauen will
		} else {

			// Do Nothing
		}
	}


	/**
	 * Führt einen Reset der Form durch
	 * 
	 * @param {Int} mode Modus 0 = Reset auf Standard, 1 = Alle leeren, 2 = nur Validierung löschen
	 */
	reset(mode) {

		var me = this;

		me.log('Reset >' + mode + '<');

		// Standard Modus = 0
		mode = mode || 0;

		// Reset State aktivieren
		me.globalNoRevalidation = true;

		// Bei 0 und 1 jeweils die Form Clearen
		if ([0, 1].indexOf(mode) >= 0) {

			// Form Bereinigen
			me.clearForm();
		}

		// Alten Stand wiederherstellen
		if (mode == 0) {

			// Alten Daten setzen
			me.setData(me.initFormData, false, true);
		}

		// Wenn FormValidation existiert, dann die Form zurücksetzen
		// Allerdings nur die Icons und Fehler etc.
		if (me.fvInstanz) {

			me.fvInstanz.resetForm(false);
		}

		me.resizeUnitAll();

		// Reset Event
		me.form.trigger('reset', [mode]);

		// In Reset State
		me.globalNoRevalidation = false;
	}


	/**
	 * Form löschen ohne FormValidation?
	 * // TODO: Form leeren
	 */
	clearForm() {

		var me = this;

		me.log('Clear Form');

		// Alle Inputs leeren
		me.form.find(me.fields.join(',')).each(function (index, value) {
			me.clearField($(this).attr('name'));
		});

		// Callback für weitere Daten
		if (typeof me.setAdditionalData == 'function') {
			me.setAdditionalData(false, false, false);
		}

	}

	/**
	 * 
	 * @param {*} name 
	 */
	clearField(name) {
		var me = this;
		me.setFieldData(name, false);
	}



	/**
	 * Sorgt dafür, dass nur die richtigen Felder ausgelesen werden
	 * Hier werden auch die Sub-Forms berücksichtig
	 * 
	 */
	getFields(namesOnly) {

		var me = this;
		namesOnly = namesOnly || false;

		// Felder
		var fields = [];

		// Felder
		me.container.find(me.fields.join(',')).each(function () {

			var el = $(this);

			// Wenn das Feld zur Form gehört
			if (me.belongsToForm(el)) {

				fields.push((namesOnly) ? el.attr('name') : el);

			}
		});

		return fields;
	}


	/**
	 * Prüft ob ein jQuery Element zu dieser Form Gehört
	 * 
	 */
	belongsToForm(el) {

		var me = this;
		var result = false;

		// Prüfen ob es eine Sub Form ist!
		if (me.form.hasClass('sub-form')) {

			if (el.closest('.sub-form').attr('id') == me.form.attr('id')) {
				result = true;
			}

			// Falls es sich nicht um eine Subform handelt
		} else {

			// Wenn eine Subform gefunden wurde
			if (!el.closest('.sub-form').length) {
				result = true;
			}
		}

		// Wenn dieses Element Teil einer DataTable ist 
		if (el.closest('.dataTables_wrapper').length) {
			result = false;
		}

		return result;
	}


	/**
	 * Sammelt alle Daten aus einer Form ein und packt diese in ein Objekt.
	 * Unterstützt werden aktuell: 
	 * - Input (text, password, hidden, email, date, time)
	 * - Input (checkbox, radio)
	 * - Select & Multi Select
	 * - Textarea
	 * - Select2
	 * - TODO: Summernote
	 * 
	 * 		{
	 * 			"text": "Text Wert",
	 * 			"checkbox": true,
	 * 			"radio": "Gecheckte Radio",
	 * 			"select": "Ausgewählter Wert",
	 * 			"textarea": "Langtext aus einer Textarea"
	 * 		}
	 * 
	 *	Außerdem können mit dem Callback getAdditionalData() noch beliebige weitere Werte dem Array zurgeführt werden
	 * 
	 * @returns {Object} Gibt alle Daten als Objekt zurück
	 */
	getData() {

		var me = this;

		me.log('form', '~' + me.name + '~ - Get Data');

		// Result Container
		var result = {};

		var fields = me.getFields();

		// Für alle Felder
		$.each(fields, function () {

			var name = $(this).attr('name');
			var tagName = $(this).prop('tagName').toLowerCase();
			var value = $(this).val();

			// Wenn der Name gesetzt ist
			if (typeof $(this).attr('name') != 'undefined') {

				// INPUT
				// *********************
				if (tagName == 'input') {

					var type = $(this).attr('type').toLowerCase();

					// Alle Textbasierenden + File und Range
					// *************************************
					if (['text', 'search', 'password', 'hidden', 'email', 'date', 'time', 'file', 'range', 'number'].indexOf(type) >= 0) {

						result[name] = value;

						// Checkbox
						// ********
					} else if (type == 'checkbox') {

						// Wenn die Checkboxen als Array angegeben werden
						// Das wird nur gemacht, wenn diese zusammen Validiert werden sollen
						if (name.includes('[]')) {

							// Prüfen ob es den Namen schon gibt, damit nicht überschrieben wird
							result[name] = (typeof result[name] == 'undefined') ? false : result[name];

							// Wenn eine Checkbox gecheckt ist
							if ($(this).prop('checked')) {

								// Zu einem Array umwandeln
								result[name] = (result[name]) ? result[name] : [];

								// Einen Wert in das Array pushen
								result[name].push({
									value: value,
									text: $(this).parent().find('label').text()
								});
							}

							// Ansonsten Standard-Checkbox
						} else {
							result[name] = {
								value: value,
								checked: $(this).prop('checked')
							}
						}

						// Radio
						// *****
					} else if (type == 'radio') {

						// Init Objekt
						if (typeof result[name] == 'undefined') {
							result[name] = false;
						}

						// Wenn das Radio aktiviert war den Wert schreiben
						result[name] = ($(this).prop('checked')) ? value : result[name];
					}

					// Select
					// ******
				} else if (tagName == 'select') {


					// Wenn es ein Multi Select ist
					if ($(this).prop('multiple')) {

						var temp = [];

						result[name] = [];

						// Loop 
						$.each(value, function (i, v) {
							temp.push(v);
						});

						$('option:selected', this).each(function (index) {
							result[name].push({
								'value': temp[index],
								'text': $(this).text()
							});
						});

						// Get
						if (result[name].length == 0) {
							result[name] = false;
						}

						// Wenn es normaler Select ist
					} else {

						// 
						result[name] = {
							'value': value,
							'text': $('option:selected', this).text()
						};
					}

					// Textarea
					// ********
				} else if (tagName == 'textarea') {

					//  Prüfen ob es ein Summernote ist
					if ($(this).next().hasClass("note-editor")) {

						// Summernote Code setzen
						result[name] = $(this).summernote('code');

					} else {

						result[name] = value;
					}
				}

				// Wenn nicht, dann die Fehlermeldung ausgeben
			} else {

				// Bei Select2 wird eine Textarea ohne Name ausgegeben.
				// Außerdem wird scheinbar irgendwo ein hidden input Field erstellt, auch das sollte nicht ausgelesen werden
				// Diese sollte nicht mit ausgelesen werden!
				if (!$(this).hasClass('select2-search__field') && !$(this).get(0) == '<input type="hidden">') {
					console.warn('Bei einem Feld fehlt der Name!');
					console.log($(this).get(0));
				}
			}

		});

		// Callback für weitere Daten
		if (typeof me.getAdditionalData == 'function') {
			result = me.getAdditionalData(result);
		}

		// Return
		return result;

	}


	/**
	 * 
	 * @returns 
	 */
	getFieldData(name) {
		var me = this;
		var data = me.getData();
		return data[name];
	}


	/**
	 * 
	 * Synonym für {@link #getFieldData}
	 * @returns Daten eines Feldes
	 */
	getElData(name) {
		var me = this;
		return me.getFieldData(name);
	}


	/**
	 * Alte Funktion, falsche Namenssyntax
	 */
	getDataField(name) {
		console.error('Alte Funktion, bitte getFieldData oder getElData nutzen');
	}


	/**
	 * Setzt die Daten in Input Fields ein. Ist das Equivalent zu getData()
	 * 
	 * @param {Object} data Ein Objekt mit Key -> Value paaren
	 * @param {Boolean} asInit legt fest ob die Daten als Standard init Daten hinterlegt werden sollen
	 * @param {Boolean} noRevalidate legt fest ob die Daten als Standard init Daten hinterlegt werden sollen
	 */
	setData(data, asInit, noRevalidate) {

		// Init
		var me = this;
		asInit = asInit || false;
		noRevalidate = noRevalidate || false;
		var hasGlobalRevalidation = false;

		// Falls keine Neuvalidierung geschehen soll
		if (noRevalidate) {

			// Hier muss geprüft werden ob die setData Funktion direkt aufgerufen wird
			// Falls ja, darf später der me.globalNoRevaldation Flag nicht entfernt werden!
			hasGlobalRevalidation = (me.globalNoRevalidation) ? true : false;

			// Globale No Revalidation auf True setzen
			me.globalNoRevalidation = true;
		}

		// Alle Daten durchgehen
		for (var name in data) {
			me.setFieldData(name, data[name]);
		}

		// Wenn FormValidation aktiv ist, dann muss hier revalidiert werden
		if (me.fvInstanz && !noRevalidate) {

			// Alle Felder von FormValidation durchgehen
			$.each(me.fvInstanz.getFields(), function (index, value) {

				// Feld erneut validieren, damit wird nur das Feld validiert.
				// Es wird nicht die komplette Form abgeschickt.
				me.fvInstanz.revalidateField(index);
			});
		}

		// Callback für weitere Daten
		if (typeof me.setAdditionalData == 'function') {
			me.setAdditionalData(data, asInit, noRevalidate);
		}

		// Daten einsetzen
		if (asInit) {
			me.initFormData = me.getData();
		}

		// Zurücksetzen der Globalen Revalidierung
		if (!hasGlobalRevalidation) {
			me.globalNoRevalidation = false;
		}

		// Set Data Event
		me.container.trigger('setData', [data, asInit, noRevalidate]);

		// Resize Unit
		me.resizeUnitAll();

	}

	setDataField(name, data) {
		console.error('Neue Namensschreibweise: setFieldData Bitte anpassen!');
	}

	/**
	 * Set Some Data
	 */
	setSomeData(data) {
		var me = this;

		// Schleife
		for(var item in data) {
			me.setFieldData(item, data[item]);
		}
	}

	setFieldData(names, data) {

		var me = this;

		// Data Initalisieren
		data = data || false;
		names = (Array.isArray(names)) ? names : [names];

		// Schleife durch mehrere 
		$.each(names, function (index, name) {

			// Wenn es sich um einen Input handelt
			me.container.find('input[name="' + name + '"]').each(function () {

				// Element
				var el = $(this);

				if (me.belongsToForm(el)) {

					// Typ des Inputs herausfinden
					var type = el.attr('type');

					// Prüfen ob es sich um einen Textwert handelt
					if (['text', 'search', 'password', 'hidden', 'email', 'number', 'date', 'time'].indexOf(type) >= 0) {

						// Textwert setzen
						el.val((data || data === "0" || data === 0) ? data : "");

						// Wenn es sich um eine Checkbox handelt
					} else if (type == 'checkbox') {

						// Checkbox Verbund - Multicheckboxes
						if (name.includes('[]')) {

							// Standardmäßig alle auf false setzen
							el.each(function () {
								$(this).prop('checked', false);
							});

							// Wenn Daten vorhanden sind
							if (data) {

								// Die entsprechenden Werte durchsuchen
								$.each(data, function (index, setValue) {

									// Jedes der Elemente durchgehen
									el.each(function () {

										// Werte miteinander vergleichen
										if ($(this).val() == ((typeof setValue == 'object') ? setValue.value : setValue)) {

											// Wenn die Values identisch sind, dann die checkbox aktivieren
											$(this).prop('checked', true);
											return false;
										}
									});
								});
							}

							// Einzelne Checkboxen
						} else {

							// Wenn ein vollständiges Obejekt übergeben wurde, dann aus dem Objekt den checked Wert nehmen
							// Ansonsten muss der Data Wert direkt ein Boolean sein
							el.prop('checked', me.getCbStatus(data));
						}

					} else if (type == 'radio') {

						// Alle Radio auf 0 setzen
						el.prop('checked', false);

						// Nur den gewünschten Wert setzen (falls dieser existiert)
						$('input[name=' + name + '][value="' + data + '"]').prop('checked', true);

					} else if (type == 'range') {

						el.val((data) ? data : 0);

					} else if (type == 'file') {

						el.val((data) ? data : "");

					} else {
						console.warn('Der Input >' + name + '< hat einen nicht unterstützen Datentyp >' + type + '<');
					}

					el.trigger('form-input');
				}
			});



			// Wenn es sich um einen Input handelt
			me.container.find('select[name="' + name + '"]').each(function () {

				// Element
				var el = $(this);

				if (me.belongsToForm(el)) {

					var isMulti = (el.prop('multiple')) ? true : false;

					// QUICK-SELECT
					// *********************************************
					if (el.hasClass('init-quickselect')) {

						// Wenn es Daten gibt
						if (data) {

							// Zurücksetzen, wenn es ein Multi Feld ist
							if (isMulti) {

								// Reset
								me.qs[name].reset();

								// Schleife durch alle Daten
								for (var i = 0; i < data.length; i++) {

									if ((data[i].value && data[i].text)) {
										me.qs[name].setData(data[i].value, data[i].text);
									} else if (data[i]) {
										me.qs[name].setData(data[i]);
									}
								}

								// Single
							} else {
								if ((data.value && data.text)) {
									me.qs[name].setData(data.value, data.text);
								} else if (data) {
									me.qs[name].setData(data, false);
								} else {
									me.qs[name].reset();
								}
							}


							// Wenn es keine Daten gibt
						} else {
							me.qs[name].reset();
						}

						// ANDERE SELECT 
						// **********************************************
					} else {

						var searchValue = data;

						// Prüfen
						if (isMulti) {

							if (data) {

								searchValue = [];

								// Loop durch das Array durchführen
								$.each(data, function (index, setValue) {

									// Prüfen ob es ein Objekt ist oder nicht
									searchValue.push((typeof setValue == 'object') ? setValue.value : setValue);
								});
							}

							// Wenn es nicht Multi ist
						} else {
							searchValue = (typeof data == 'object') ? data.value : searchValue;
						}

						// Wieder den ersten Suchen
						if (!searchValue && !isMulti) {

							// Für jede Option
							el.find('option').each(function () {
								if (!$(this).attr('value')) {
									$(this).prop('selected', true);
									return false;
								}
							});

						} else {

							// Wert setzen
							el.val(searchValue);

						}

						// Wenn es ein Standard Select ist
						if (el.hasClass('select2-hidden-accessible')) {
							el.trigger('change');
						}
					}
				}
			});

			// Wenn es sich um einen Input handelt
			me.container.find('textarea[name="' + name + '"]').each(function () {


				// Element
				var el = $(this);

				// Prüfen ob es ein Summernote Element ist
				if (me.belongsToForm(el)) {

					//  Prüfen ob es ein Summernote ist
					if (me.isSummernoteEl(el)) {

						// Summernote Code setzen
						el.summernote('code', data);

						// Wenn nicht
					} else {

						// Daten setzen
						el.val((data) ? data : "").trigger('input');

						// AutoSize anwenden
						if (!el.hasClass('no-autosize')) {
							autosize.update(el);
						}
					}
				}
			});
		});
	}

	getCbStatus(data) {

		if (typeof data == 'object') {
			var isChecked = (data.checked && (data.checked === 1 || data.checked === '1' || data.checked === true)) ? true : false;
		} else {
			var isChecked = (data && (data === 1 || data === '1' || data === true)) ? true : false;
		}

		return isChecked;
	}

	saving() {

		var me = this;
		me.defaultSaving();
	}

	defaultSaving() {

		var me = this;

		me.log('form', '~' + this.name + '~ - Saving');

		me.setReadonly('true');

		// Loader
		//app.notify.loader.fire();

		me.container.trigger('saving');
	}


	/**
	 * Gibt alle Submit Buttons zurück
	 * @returns {Array} Ein Array mit allen Submit Buttons als jQuery Objekt oder als HTML
	 */
	getSubmitButtons(asHtml) {

		var me = this;

		// Als HTML oder als jQuery Objekt
		asHtml = asHtml || false;

		// Alle Elemente
		var elements = [];

		me.container.find('button, .btn-form-save').each(function () {

			if ($(this).hasClass('btn-form-save') || ($(this).prop('tagName').toLowerCase() == 'button' && (typeof $(this).prop('type') == 'undefined' || $(this).prop('type') == 'submit'))) {

				// Prüfen ob er zur Form gehört
				if (me.belongsToForm($(this))) {
					elements.push((asHtml) ? $(this).get(0) : $(this));
				}
			}

		});

		return elements;
	}



	saved(error) {
		var me = this;

		// 
		me.defaultSaved(error);

		// 
		me.setReadonly(false);
	}

	defaultSaved(error) {

		var me = this;

		if (me.debug) { me.log('form', '~' + this.name + '~ - Saved'); }

		// Alle Submit Buttons deaktivieren
		$.each(me.getSubmitButtons(), function () {
			$(this).prop('disabled', false);
		});

		me.isSaving = false;

		// Saved 
		me.container.trigger('saved', [error]);

	}

	/**
	 * Standard Success Funktion
	 */
	defaultSuccess() {

	}

	/**
	 * Standard Error Funktion
	 */
	defaultError() {

	}

	initValidation(fields, plugins) {

		var me = this;

		me.log('Validierung initalisieren');

		me.hasValidation = true;

		// Schutz, damit FormValidation nicht mehrmals aktiviert werden aknn
		if (!me.fvInstanz) {

			// Init Werte
			fields = fields || {};
			plugins = plugins || false;

			if (me.debug) { me.log('form', '~' + this.name + '~ - Init Validation'); }

			// Init Auto Validation
			var autoFields = me.initAutoValidation();

			// Fields
			fields = $.extend({}, autoFields, fields);

			// Standard Plugins definieren
			var standardPlugins = {
				declarative: new FormValidation.plugins.Declarative({
					html5Input: true,
				}),
				trigger: new FormValidation.plugins.Trigger(),
				bootstrap5: new FormValidation.plugins.Bootstrap5({
					rowSelector: '.form-group',
				}),

				// Alle Submit Buttons - Hier werden alle mit dem Typ Submit gesetz
				submitButton: new FormValidation.plugins.SubmitButton({
					buttons: function (form) {

						// Submit Buttons holen
						var elements = me.getSubmitButtons(true);

						/*
						if(elements.length == 0) {
							console.warn('Es wurde kein Submit Button im Container angegeben!');							
						}
						*/

						return elements;
					},
				}),
				icon: new FormValidation.plugins.Icon({
					valid: 'fa fa-check',
					invalid: 'fa fa-times',
					validating: 'fa fa-refresh'
				}),
			};


			// Wenn alternative Plugins mitgegeben wurden, dann überschreiben
			standardPlugins = (plugins) ? plugins : standardPlugins;

			// FormValidation Instanz
			me.fvInstanz = FormValidation.formValidation(me.form.get(0), {

				// Set the default locale
				locale: 'de_DE',
				localization: FormValidation.locales.de_DE,

				// Die Felder werden als Parameter mit in die Funktion übergeben. 
				// Sie sollten unter assets/validation-fields.js hinterlegt sein
				fields: fields,

				// Standard-Plugins
				plugins: standardPlugins
			});

			// Remove Fields
			var fields = me.getFields(true);

			$.each(me.fvInstanz.getFields(), function (index, value) {
				if (fields.indexOf(index) < 0) {
					me.fvInstanz.removeField(index);
				}
			});

			// FormValidation on Valid
			me.fvInstanz.on('core.form.valid', function () {
				me.resizeUnitAll();
				me.container.trigger('valid');
				me.container.trigger('submit');
			});

			// FormValidation on Invalid
			me.fvInstanz.on('core.form.invalid', function () {
				me.resizeUnitAll();
				me.container.trigger('invalid');
			});




		} else {
			console.warn('FormValidation wurde bereits initalisiert');
		}
	}

	/**
	 * Auto Validation ist ein Mechanismus um verschiedene Standardmethoden zu aktivieren.
	 *  
	 */
	initAutoValidation() {

		var me = this;

		// Alle Felder
		var fields = me.getFields();

		// Auto Validation Fields
		var autoValFields = {};

		// Für alle Felder
		$.each(fields, function () {

			var el = $(this);

			// Gehört dieses Element überhaupt zur Form?
			if (me.belongsToForm(el)) {

				var name = el.attr('name');


				if (el.hasClass('fv-date') || el.hasClass('fv-date-past') || el.hasClass('fv-date-future')) {

					// Formatierung des Datums
					var format = (el.data('date-format')) ? el.data('date-format') : 'YYYY-MM-DD';

					var min = -150;
					var minTime = 'years';
					var max = 150;
					var maxTime = 'years';

					// Wenn es Vergangenheit oder Zukunft ist, jeweils das min oder max Date anpassen
					if (el.hasClass('fv-date-past')) {
						max = (el.hasClass('fv-date-current')) ? 0 : -1;
						maxTime = 'days';
					} else if (el.hasClass('fv-date-future')) {
						min = (el.hasClass('fv-date-current')) ? 0 : 1;
						minTime = 'days';

					}

					// Zur Field Liste hinzufügen
					autoValFields[name] = {
						validators: {
							date: {
								format: format,
								min: moment().add(min, minTime).format(format),
								max: moment().add(max, maxTime).format(format)
							}
						}
					};

				} else if (el.hasClass('fv-plz')) {
					console.log('-- PLZ Validator ');

					// Wenn es ein Summernote Element ist
				} else if (me.isSummernoteEl(el)) {

					if (el.data('fv-notempty') === true) {

						// Zur Field Liste hinzufügen
						autoValFields[name] = {
							validators: {
								callback: {
									message: 'Bitte füllen Sie den Editor aus',
									callback: function (input) {
										var code = $('textarea[name=' + name + ']').summernote('code');
										return (code !== '' && code !== '<p><br></p>');
									}
								}
							}
						};
					}
				}
			}
		});


		return autoValFields;
	}


	/**
	 * Prüft ob es Unterschiede in der Form gibt
	 * 
	 * @param {Array|String|Boolean} [fields=false] Wenn angegeben, werden nur diese Felder verglichen
	 * 
	 */
	hasChange(fields) {
		var me = this;

		fields = fields || false;

		// Wenn mit dem Parameter Fields angegeben wurde
		if (fields) {

			// String zu einem Array machen
			fields = (Array.isArray(fields)) ? fields : [fields];

			// Neu 1 und 2 anlegen
			var new1 = {};
			var new2 = {};

			// Init Form Data loopen
			$.each(me.initFormData, function (index, value) {
				if (fields.indexOf(index) >= 0) {
					new1[index] = value;
				}
			});

			// Init Form Data loopen
			$.each(me.getData(), function (index, value) {
				if (fields.indexOf(index) >= 0) {
					new2[index] = value;
				}
			});

			// Die neuen Objekte vergleichen
			var result = (JSON.stringify(new1) == JSON.stringify(new2)) ? false : true;

		} else {

			// Die vollständigen Objekte vergleichen
			var result = (JSON.stringify(me.initFormData) == JSON.stringify(me.getData())) ? false : true;
		}

		return result
	}




	/**
	 * Daten vergleichen
	 */
	compareData(customPrevFormData) {

		var me = this;

		if (me.debug) { me.log('form', '~' + this.name + '~ - Compare Data'); }

		// Prüfen 
		var prevFormData = (customPrevFormData) ? customPrevFormData : this.initFormData;

		// Aktuelle Form Daten holen
		var newFormData = this.getData();

		// Unterschiede
		var diff = {};

		// Check
		$.each(prevFormData, function (index, value) {

			// Wenn die Werte nicht gleich sind 
			if (value !== newFormData[index]) {
				diff[index] = {
					vorher: prevFormData[index],
					nachher: newFormData[index],
					art: 'change'
				}
			}
		});

		return diff;
	}

	/**
	 * Funktion zum suchen eines Felds
	 * 
	 * Ersetzt das Stände form.container.find('input[name=field]');
	 * So kann man jetzt form.find('name','input');
	 * 
	 * Der zweite Parameter ist optional
	 * 
	 */
	find(name, type) {

		// Init
		var me = this;
		type = type || false;

		// To Find
		var toFind = ((type) ? type : "") + '[name="' + name + '"]';

		return me.container.find(toFind);

	}



	/**
	 * Die Log Funktion greift auf die Standard-Log Klasse zu. 
	 * Der Unterschied ist, dass hier Abfrage wird, ob die Form auf debug steht. 
	 * Nur wenn das der Fall ist, dann wird auch geloggt. 
	 * 
	 * @param {String} area Bereich
	 * @param {String} message Nachricht
	 */
	log(message) {
		var me = this;
		if (me.options.debug) {
			console.log(me.name + ' - ' + message);
		}
	}
}