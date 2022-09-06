/**
 * App Assign für Select 2
 * 
 */
var appAssignFab = {

    /**
     * 
     * 
     */
    initFabButtons: function () {

        var me = this;

        // 
        $('body').on('click', '.fab-parent', function () {

            // Zeit
            var childrenFadeIn = 100;
            var buttonFadeInTime = 200;
            var i = 0;

            var parent = $(this);
            var children = parent.closest('.fab-container').find('.fab-children');

            if (!parent.hasClass('fab-active')) {

                parent.addClass('fab-active');

                // Wenn der FAB die Klasse open hat!
                if (parent.hasClass('fab-open')) {

                    children.each(function () {
                        var el = $(this);
                        
                        // Beim FadeOut wird das Element direkt nach der Animation entfernt
                        el.delay(i).fadeOut(childrenFadeIn, function () {
                            me.setFabLabel(el, false, buttonFadeInTime);
                        });

                        i = i + childrenFadeIn;
                    });

                    parent.removeClass('fab-open');

                    // Rotate Button
                    if (parent.hasClass('fab-rotate')) {
                        parent.find('i').css({ 'transform': 'rotate(0deg)' });
                    }


                    // Wenn es Sie nicht hat
                } else {

                    parent.addClass('fab-open');

                    $(children.get().reverse()).each(function () {
                        var el = $(this);

                        // Beim Fade In beide gleichzeitig einblenden
                        el.delay(i).fadeIn(childrenFadeIn);
                        me.setFabLabel(el, true);

                        i = i + childrenFadeIn;
                    });

                    // Rotate Button
                    if (parent.hasClass('fab-rotate')) {
                        parent.find('i').css({ 'transform': 'rotate(180deg)' });
                    }
                }

                // Switch Button
                if (parent.hasClass('fab-switch')) {
                    var oldIcon = parent.find('i').attr('class');
                    var newIcon = parent.data('switch');
                    parent.data('switch', oldIcon);
                    parent.find('i').fadeOut(buttonFadeInTime, function () {
                        parent.find('i').removeClass().addClass(newIcon).fadeIn(buttonFadeInTime);
                    })
                }


                var parentChangeTime = buttonFadeInTime * 2;

                var finishTime = ((parentChangeTime > i) ? parentChangeTime : i) + 50;

                setTimeout(function () {
                    parent.removeClass('fab-active');
                }, finishTime);
            }
        });

    },

    /**
     * Ein- und Ausblenden des FAB Labels
     * @param {*} el Das Element um das es geht
     * @param {*} show `true` oder `false` ob ein- oder ausgeblendet werden soll
     * @param {*} buttonFadeInTime Die Zeit zum einblenden. (wird nur beim FadeIn benötigt)
     */
    setFabLabel(el, show, buttonFadeInTime) {
        
        // Prüfen ob der Button ein Label hat
        if(typeof el.data('label') != 'undefined') {

            // Wenn das Label angezeigt werden soll
            if(show) {
                el.append('<div class="fab-label">' + el.data('label') + '</div>');
                el.find('.fab-label').fadeIn(buttonFadeInTime);

            // Wenn das Label ausgeblendet werden soll
            } else {
                el.find('.fab-label').remove();
            }
        }
    }

}