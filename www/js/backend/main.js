/**
 * Created by stijnvanderkimpen on 24/11/16.
 */

var url = window.location.href;

$(document).ready(function() {
    console.log("Start");

    WYZYWIG();
    sortableWidgets();
    toDoList();
    widgets();
    datatables();
    confirm();

    console.log("All functions loaded");

    //bootstrap WYSIHTML5 - text editor
    function WYZYWIG() {
        $(".textarea").wysihtml5();
    }

    //HIDE MESSAGE
    $('.succes_hide').fadeIn('fast').delay(2000).fadeOut('fast');
    $('.error_hide').fadeIn('fast').delay(2000).fadeOut('fast');
    //HIDE BOX MESSAGE
    $('.alert-success').fadeIn('fast').delay(3000).fadeOut('slow');
    $('.alert-danger').fadeIn('fast').delay(3000).fadeOut('slow');

    function sortableWidgets() {
        //Make the dashboard widgets sortable Using jquery UI
        $(".connectedSortable").sortable({
            placeholder: "sort-highlight",
            connectWith: ".connectedSortable",
            handle: ".box-header, .nav-tabs",
            forcePlaceholderSize: true,
            zIndex: 999999
        });
        $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");

        //jQuery UI sortable for the todo list
        $(".todo-list").sortable({
            placeholder: "sort-highlight",
            handle: ".handle",
            forcePlaceholderSize: true,
            zIndex: 999999
        });
    }
    //TO-DO
    function toDoList() {
        //Toggle Show/hide TO DO List button
        $('#toDoButton').click(function(){
            $('#newToDO').toggle();
        })

        //Toggle +/-
        $('#toDoButton').click(function(){
            $(this).find('i').toggleClass('fa-plus fa-minus');
        })

        $.fn.editable.defaults.mode = 'inline';
        var token = $('meta[name="csrf-token"]').attr('content');

        //make TO DO list editable
        $('.toDoText').editable({
            validate: function(value) {
                if($.trim(value) == '')
                    return 'Verplicht in te vullen.';
            },
            url: url + '/updateTextField',
            type: 'POST',
            params: {_token:token},
            success: function(response, newValue) {
                // get the current pk value
                var current_pk = $(this).data('pk');
                // Hide info label
                var current_label = 'dateTime_'+current_pk;
                $('#'+current_label).hide();
            }
        });
    }
    function widgets(){

        //SEARCH INPUT
        $(".select2").select2();

        //FONT AWESOME PICKER
        $('.icp-auto').iconpicker();

        $('.icp').on('iconpickerSelected', function(e) {
            $('.lead .picker-target').get(0).className = 'picker-target fa-3x ' +
                e.iconpickerInstance.options.iconBaseClass + ' ' +
                e.iconpickerInstance.options.fullClassFormatter(e.iconpickerValue);
        });

    }
    function datatables(){
        $('table.display').DataTable(
            {
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.7/i18n/Dutch.json"
                },
                "order": [[ 0, "asc" ]],
                "columnDefs": [
                    {
                        "targets": [ 0 ],
                        "visible": false,
                        "searchable": false
                    }
                ],
                responsive: true,
            }
        );

        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    }
    function confirm(){
        //PERM DELETE
        $('#confirmDelete').on('show.bs.modal', function (e) {
            $message = $(e.relatedTarget).attr('data-message');
            $(this).find('.modal-body p').text($message);
            $title = $(e.relatedTarget).attr('data-title');
            $(this).find('.modal-title').text($title);

            // Pass form reference to modal for submission on yes/ok
            var form = $(e.relatedTarget).closest('form');
            $(this).find('.modal-footer #confirm').data('form', form);
        });

        <!-- Form confirm (yes/ok) handler, submits form -->
        $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
            $(this).data('form').submit();
        });
    }

});
