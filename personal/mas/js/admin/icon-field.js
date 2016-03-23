jQuery('.erika_font_awesome_container').each( function(){
    var me = jQuery(this);
    var input = me.find('input');

    me.find('.erika_font_item').click(function(e){
        e.preventDefault();
        var icon = jQuery(this);
        input.val( icon.attr('fas-ic-value') );
        input.trigger('change');
        me.find('li').removeClass('active');
        icon.parent().addClass('active');
    });

});