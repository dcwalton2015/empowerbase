jQuery(document).ready(function($){
    $('#accordion-section-shift_display').find('.customize-section-description').appendTo('#customize-control-display_post_comments');
    $('#accordion-section-shift_layout').find('.customize-section-description').appendTo('#customize-control-layout');

    // set context to customizer panel outside iframe site content is in
    var panel = $('html', window.parent.document);

    addLayoutThumbnails();

    // replaces radio buttons with images
    function addLayoutThumbnails() {

        // get layout inputs
        var layoutInputs = panel.find('#customize-control-layout').find('input');

        // add the appropriate image to each label
        layoutInputs.each( function() {
            $(this).parent().css('background-image', 'url("' + ct_shift_customizer.templateDir + '/assets/images/' + $(this).val() + '.png")');

            // add initial 'selected' class
            if ($(this).prop('checked')) {
                $(this).parent().addClass('selected');
            }
        });

        // watch for change of inputs (layouts)
        panel.on('click', '#customize-control-layout input', function () {
            addSelectedLayoutClass(layoutInputs, $(this));
        });
    }

    // add the 'selected' class when a new input is selected
    function addSelectedLayoutClass(inputs, target) {

        // remove 'selected' class from all labels
        inputs.parent().removeClass('selected');

        // apply 'selected' class to :checked input
        if (target.prop('checked')) {
            target.parent().addClass('selected');
        }
    }
});