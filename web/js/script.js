$(document).ready(()=>{
    // Sorting and request for update categories
    $( function() {
        $( ".sortable" ).sortable({
            connectWith: ".connectedSortable",
            handle: ".child_as_handle",
            stop: function(evt, ui) {
                let item = $(ui.item[0])
                let parent_id = item.closest('.category_parents_wrapper').attr('data-id');
                let self_id = item.attr('data-id');
                let data = {};
                data.parent_id = parent_id;
                data.self_id = self_id;
                if (parent_id && self_id && parent_id !== self_id) {
                    $.post(
                        '/category/update-parent', {
                            data : JSON.stringify(data)
                        },
                        function(result) {
                            if (!result) {
                                $('.sorting_alert').show();
                                setTimeout(()=>{
                                    $('.sorting_alert').hide();
                                } , 4000)
                            }
                        }
                    );
                }
            }
        }).disableSelection();
    } );

});