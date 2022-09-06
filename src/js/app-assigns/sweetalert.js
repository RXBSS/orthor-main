/**
 * App Assign für Sweet Alert 
 * 
 */
var appAssignSweetAlert = {

    /**
    * Standard Sweet Alert aufruf
    */
    swal: Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger',
            denyButton: 'btn btn-secondary'
        },
        buttonsStyling: false,
        showClass: {
            backdrop: 'swal2-noanimation',
            popup: '',
            icon: ''
        },
        hideClass: {
            popup: '',
        },
    }),

    /**
     * Alert
     */
    alert: {

        success: Swal.mixin({
            icon: "success",
            title: "Erfolgreich!",
            text: "Die Aktion wurde vollständig durchgeführt.",
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-secondary',
                denyButton: 'btn btn-secondary'
            },
            confirmButtonText: '<i class="fa-solid fa-check"></i> Bestätigen',
            cancelButtonText: '<i class="fa-solid fa-times"></i> Abbrechen',
            buttonsStyling: false,
            showClass: {
                backdrop: 'swal2-noanimation',
                popup: '',
                icon: ''
            },
            hideClass: {
                popup: '',
            },
        }),

        error: Swal.mixin({
            icon: "error",
            title: "Fehler!",
            text: "Es ist ein Fehler aufgetreten.",
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-secondary',
                denyButton: 'btn btn-secondary'
            },
            confirmButtonText: '<i class="fa-solid fa-check"></i> Bestätigen',
            cancelButtonText: '<i class="fa-solid fa-times"></i> Abbrechen',
            buttonsStyling: false,
            showClass: {
                backdrop: 'swal2-noanimation',
                popup: '',
                icon: ''
            },
            hideClass: {
                popup: '',
            },
        }),

        /**
         * Ist im Vergleich zu den anderen Funktionen kein Mixin
         * @param {*} title Titel der Fehlermeldung
         * @param {*} preMessage Nachricht die in normaler Form angezegit wird
         * @param {*} debugMessage Nachricht in <pre></pre> Formatierung
         */
        debugError: function (title, preMessage, debugMessage) {

            // Fehlermeldung ausgeben
            app.alert.error.fire({
                width: '100%',
                title: title,
                html: preMessage + ((debugMessage) ? "<hr><pre style='text-align:left;max-height:50vh;background: #f1f1f1;padding:5px;font-size: 11px;'>" + debugMessage + "</pre>" : "")
            });
        },

        warning: Swal.mixin({
            icon: "warning",
            title: "Warnung!",
            text: "Dies ist eine Warnung.",
            customClass: {
                confirmButton: 'btn btn-warning',
                cancelButton: 'btn btn-secondary',
                denyButton: 'btn btn-secondary'
            },
            buttonsStyling: false,
            showClass: {
                backdrop: 'swal2-noanimation',
                popup: '',
                icon: ''
            },
            hideClass: {
                popup: '',
            },
        }),

        info: Swal.mixin({
            icon: "info",
            title: "Info!",
            text: "Das ist eine Info",
            customClass: {
                confirmButton: 'btn btn-secondary',
                cancelButton: 'btn btn-secondary',
                denyButton: 'btn btn-secondary'
            },
            buttonsStyling: false,
            showClass: {
                backdrop: 'swal2-noanimation',
                popup: '',
                icon: ''
            },
            hideClass: {
                popup: '',
            },
        }),

        question: Swal.mixin({
            icon: "question",
            title: "Auswahl!",
            text: "Bite wählen Sie.",
            showCancelButton: true,
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-secondary',
                denyButton: 'btn btn-secondary',
                input: 'form-control',
                inputLabel: 'form-floating'
            },
            allowOutsideClick: false,
            confirmButtonText: '<i class="fa-solid fa-check"></i> Ja',
            cancelButtonText: '<i class="fa-solid fa-times"></i> Nein',
            buttonsStyling: false,
            showClass: {
                backdrop: 'swal2-noanimation',
                popup: '',
                icon: ''
            },
            hideClass: {
                popup: '',
            },
        }),

        save: Swal.mixin({
            icon: "question",
            title: "Speichern!",
            text: "Wollen Sie Änderungen speichern oder verwerfen",
            showCloseButton: true,
            showCancelButton: true,
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-secondary',
                denyButton: 'btn btn-secondary'
            },
            allowOutsideClick: false,
            buttonsStyling: false,
            confirmButtonText: '<i class="fa-solid fa-save"></i> Speichern',
            cancelButtonText: '<i class="fa-solid fa-times"></i> Verwerfen',
            showClass: {
                backdrop: 'swal2-noanimation',
                popup: '',
                icon: ''
            },
            hideClass: {
                popup: '',
            },
        }),

        delete: Swal.mixin({
            icon: "question",
            title: "Löschen!",
            text: "Wollen Sie wirklich löschen?",
            showCloseButton: true,
            showCancelButton: true,
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-secondary',
                denyButton: 'btn btn-secondary'
            },
            allowOutsideClick: false,
            buttonsStyling: false,
            confirmButtonText: '<i class="fa-solid fa-trash"></i> Löschen',
            cancelButtonText: '<i class="fa-solid fa-times"></i> Abbrechen',
            showClass: {
                backdrop: 'swal2-noanimation',
                popup: '',
                icon: ''
            },
            hideClass: {
                popup: '',
            },
        }),

        // Loader
        loader: Swal.mixin({
            html: '<div style="margin-top: 12px;padding: 5px 0px;background: white;"><div class="d-flex"><div class="spinner-border text-primary"></div><div style="padding-left: 20px;"><h4>Wird geladen...</h4></div></div>',
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            showClass: {
                backdrop: 'swal2-noanimation',
                popup: '',
                icon: ''
            },
            hideClass: {
                popup: '',
            },
        })

    },

    /**
     * Notify
     */
    notify: {

        success: Swal.mixin({
            icon: 'success',
            title: "Erfolgreich!",
            text: "Die Aktion wurde vollständig durchgeführt.",
            toast: true,
            position: 'top-end',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger',
                denyButton: 'btn btn-secondary',
                popup: 'bg-primary',
                htmlContainer: 'text-white',
                title: 'text-white',
                icon: 'text-white'
            },
            buttonsStyling: false,
            didOpen: (toast) => {
                app.resizeSwalButtonOnOpen(toast);
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            },
        }),

        error: Swal.mixin({
            icon: 'error',
            title: "Fehler!",
            text: "Es ist ein Fehler aufgetreten.",
            toast: true,
            position: 'top-end',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger',
                denyButton: 'btn btn-secondary',
                popup: 'bg-danger',
                htmlContainer: 'text-white',
                title: 'text-white',
                icon: 'text-white'
            },
            buttonsStyling: false,
            didOpen: (toast) => {
                app.resizeSwalButtonOnOpen(toast);
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        }),

        warning: Swal.mixin({
            icon: "warning",
            title: "Warnung!",
            text: "Dies ist eine Warnung.",
            toast: true,
            position: 'top-end',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger',
                denyButton: 'btn btn-secondary',
                popup: 'bg-warning',
                htmlContainer: 'text-white',
                title: 'text-white',
                icon: 'text-white'
            },
            buttonsStyling: false,
            didOpen: (toast) => {
                app.resizeSwalButtonOnOpen(toast);
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        }),

        info: Swal.mixin({
            icon: "info",
            title: "Info!",
            text: "Das ist eine Info",
            toast: true,
            position: 'top-end',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger',
                denyButton: 'btn btn-secondary',
                popup: 'bg-info',
                htmlContainer: 'text-white',
                title: 'text-white',
                icon: 'text-white'
            },
            buttonsStyling: false,
            didOpen: (toast) => {
                app.resizeSwalButtonOnOpen(toast);
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        }),

        question: Swal.mixin({
            icon: "question",
            title: "Auswahl!",
            text: "Bite wählen Sie.",
            toast: true,
            position: 'top-end',
            timer: 3000,
            timerProgressBar: true,
            showCancelButton: true,
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-secondary',
                denyButton: 'btn btn-secondary',
            },
            confirmButtonText: '<i class="fa-solid fa-check"></i> Ja',
            cancelButtonText: '<i class="fa-solid fa-times"></i> Nein',
            buttonsStyling: false,
            didOpen: (toast) => {
                app.resizeSwalButtonOnOpen(toast);
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        }),

        save: Swal.mixin({
            icon: "question",
            title: "Speichern!",
            text: "Wollen Sie Änderungen speichern oder verwerfen",
            toast: true,
            position: 'top-end',
            timer: 3000,
            timerProgressBar: true,
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-danger',
                denyButton: 'btn btn-secondary'
            },
            buttonsStyling: false,
            didOpen: (toast) => {
                app.resizeSwalButtonOnOpen(toast);
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            },
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: '<i class="fa-solid fa-save"></i> Speichern',
            cancelButtonText: '<i class="fa-solid fa-times"></i> Verwerfen'
        }),

        delete: Swal.mixin({
            icon: "question",
            title: "Löschen!",
            text: "Wollen Sie wirklich löschen?",
            toast: true,
            position: 'top-end',
            timer: 3000,
            timerProgressBar: true,
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-secondary',
                denyButton: 'btn btn-secondary'
            },
            buttonsStyling: false,
            didOpen: (toast) => {
                app.resizeSwalButtonOnOpen(toast);
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            },
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: '<i class="fa-solid fa-trash"></i> Löschen',
            cancelButtonText: '<i class="fa-solid fa-times"></i> Abbrechen'
        }),

        // Loader
        loader: Swal.mixin({
            toast: true,
            position: 'top-end',
            html: '<div style="margin-top: 12px;padding: 5px 0px;background: white;"><div class="d-flex"><div class="spinner-border text-primary"></div><div style="padding-left: 20px;"><h4>Wird geladen...</h4></div></div>',
            showConfirmButton: false
        })
    },


    resizeSwalButtonOnOpen(el) {

        var limit = 360;
        var offset = 107;

        // 
        var sumButtonWidth = 0;

        $(el).find('.swal2-actions button').each(function () {
            if ($(this).is(":visible")) {
                sumButtonWidth = sumButtonWidth + $(this).outerWidth() + parseInt($(this).css("margin-left").replace('px', '')) + parseInt($(this).css("margin-right").replace('px', ''))
            }
        });


        if ($(el).find('.swal2-close').length && $(el).find('.swal2-close').is(":visible")) {
            sumButtonWidth = sumButtonWidth + $(el).find('.swal2-close').outerWidth();
        }

        var newSize = limit + (sumButtonWidth - (limit - offset));

        if (newSize > limit) {
            $(el).closest('body.swal2-toast-shown .swal2-container').width(newSize);
        }

    },

    initSweetAlert: function () {

        // var me = this;

        appAssignSweetAlert.swalInput();

    },





    swalInput: function () {


        // var parent = $(this);

        // var children = parent.closest('div');

        // if(!parent.hasClass('form-group')) {
        //     parent.addClass('form-group');
        // }

    }

}
