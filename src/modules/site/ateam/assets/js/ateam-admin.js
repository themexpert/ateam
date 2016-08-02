(function($){
    function openImageModal(id){
      //index.php?option=com_media&amp;view=images&amp;tmpl=component&amp;fieldid=ateam_images_'.$itemId.'

    }
    $(document).ready(function(){
      // console.log(ajaxUrl);
        // Add new form from given ajax url
        $(".action-new").on("click", function(e){
            itemId++;
            e.preventDefault();

            $.ajax({
                  url: ajaxUrl,
                  data: { name: name, itemId: itemId, adminyes: adminyes }
                }).done(function( msg ) {
                    $("#repeatable").append(msg);
            });
        });

        // Sortable
        $('#repeatable').sortable({
        	itemSelector : ".accordion-group",
            handle: 'i.icon-menu'
        });
    });

    // Change name and live update
    $(document).on('keyup', '.accordion-group .name', function(){
        var txt = $(this).val();
        $(this).closest('.accordion-group').find('.accordion-toggle .text').text( txt );
    });

    // Remove item
    $(document).on('click', '.action-remove', function(){
        var result = confirm("Click Ok button to delete, Cancel to leave.");
        if( result == true)
        {
            $(this).closest('.accordion-group').remove();
        }

    });

})(jQuery);
