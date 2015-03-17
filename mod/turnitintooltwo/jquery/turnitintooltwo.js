//var tiijq = jQuery.noConflict();
jQuery(document).ready(function($) {
    $(".js_required").show();
    $(".js_hide").hide();

    // Hide the header and footer on the modal boxes
    if ($("#view_context").html() == "box" || $("#view_context").html() == "box_solid") {
        $("#page-header").hide();
        $("#page-footer").hide();
    }

    // Configure submit paper form elements depending on what submission type is allowed
    if ($("#id_submissiontype").val() == 1) {
        $("#id_submissiontext").parent().parent().hide();
    }

    if ($("#id_submissiontype").val() == 2) {
        $("#id_submissionfile").parent().parent().hide();
    }

    $(document).on('click', '.submit_nothing', function() {
        if ( $(this).hasClass("disabled") ) return;
        $(this).addClass('disabled');
        var part_id = $(this).prop('id').split('_')[2];
        var student_id = $(this).prop('id').split('_')[3];
        var message = M.str.turnitintooltwo.submitnothingwarning.replace(/<br>/g, "\n").replace(/&#39;/g, "\'");
        var cookieseen = $.cookie('submitnothingaccept');
        if ( cookieseen || confirm( message ) ) {
            submitNothing(student_id, part_id);
        } else {
            $(this).removeClass("disabled");
        }
        return;
    });

    // Configure submit paper form elements depending on what submission type is selected
    $(document).on('change', '#id_submissiontype', function() {
        if ($("#id_submissiontype").val() == 1) {
            $("#id_submissiontext").parent().parent().hide();
            $("#id_submissionfile").parent().parent().show();
        }

        if ($("#id_submissiontype").val() == 2) {
            $("#id_submissionfile").parent().parent().hide();
            $("#id_submissiontext").parent().parent().show();
        }
    });

    // Show loading if submission passes validation
    $(document).on('submit', '.submission_form_container form', function() {
        try {
            var myValidator = validate_turnitintooltwo_form;
        } catch(e) {
            return true;
        }

        var validated = myValidator(this);

        if (validated) {

            $("#general").slideUp('slow');
            $(".submission_form_container form").slideUp('slow');
            $("#submitting_loader").slideDown('slow');

            return true;
        } else {
            return false;
        }
    });

    // Initialise and set cookie for showing the summary for this assignment
    if ($('.toggle_summary').length > 0) {
        if (!$.cookie('show_summary_'+$('#assignment_id').html())) {
            $.cookie('show_summary_'+$('#assignment_id').html(), true, { expires: 30 });
        }

        if ($.cookie('show_summary_'+$('#assignment_id').html()) == "true") {
            $('.hide_summary_'+$('#assignment_id').html()).show();
            $('.show_summary_'+$('#assignment_id').html()).hide();
            $('.introduction').slideDown();
        } else {
            $('.show_summary_'+$('#assignment_id').html()).show();
            $('.hide_summary_'+$('#assignment_id').html()).hide();
            $('.introduction').slideUp();
        }

        // Toggle Summary display on Inbox
        $('.toggle_summary img').click(function() {
            if ($(this).hasClass('show_summary_'+$('#assignment_id').html())) {
                $.cookie('show_summary_'+$('#assignment_id').html(), true, { expires: 30 });
                $('.show_summary_'+$('#assignment_id').html()).hide();
                $('.hide_summary_'+$('#assignment_id').html()).show();
                $('.introduction').slideDown();
            } else {
                $.cookie('show_summary_'+$('#assignment_id').html(), false, { expires: 30 });
                $('.show_summary_'+$('#assignment_id').html()).show();
                $('.hide_summary_'+$('#assignment_id').html()).hide();
                $('.introduction').slideUp();
            }
        });
    }

    // Initialise and set cookie for showing the peermark assignments for this assignment
    if ($('.toggle_peermarks').length > 0) {
        if (!$.cookie('show_peermarks_'+$('#assignment_id').html())) {
            $.cookie('show_peermarks_'+$('#assignment_id').html(), true, { expires: 30 });
        }

        if ($.cookie('show_peermarks_'+$('#assignment_id').html()) == "true") {
            $('.hide_peermarks_'+$('#assignment_id').html()).show();
            $('.show_peermarks_'+$('#assignment_id').html()).hide();
            $('.peermark_assignments_container').slideDown();
        } else {
            $('.show_peermarks_'+$('#assignment_id').html()).show();
            $('.hide_peermarks_'+$('#assignment_id').html()).hide();
            $('.peermark_assignments_container').slideUp();
        }

        // Toggle Peermarks display on Inbox
        $('.toggle_peermarks img').click(function() {
            if ($(this).hasClass('show_peermarks_'+$('#assignment_id').html())) {
                $.cookie('show_peermarks_'+$('#assignment_id').html(), true, { expires: 30 });
                $('.show_peermarks_'+$('#assignment_id').html()).hide();
                $('.hide_peermarks_'+$('#assignment_id').html()).show();
                $('.peermark_assignments_container').slideDown();
            } else {
                $.cookie('show_peermarks_'+$('#assignment_id').html(), false, { expires: 30 });
                $('.show_peermarks_'+$('#assignment_id').html()).show();
                $('.hide_peermarks_'+$('#assignment_id').html()).hide();
                $('.peermark_assignments_container').slideUp();
            }
        });
    }

    $(document).on('click', '.show_peermark_instructions, .hide_peermark_instructions', function() {
        var idStr = $(this).attr('id').split("_");

        if (idStr[0] == "show") {
            $('#show_peermark_instructions_'+idStr[3]).hide();
            $('#hide_peermark_instructions_'+idStr[3]).show();
            $('#peermark_instructions_'+idStr[3]).slideDown();
        } else {
            $('#show_peermark_instructions_'+idStr[3]).show();
            $('#hide_peermark_instructions_'+idStr[3]).hide();
            $('#peermark_instructions_'+idStr[3]).slideUp();
        }
    });

    // Show options for parts in mod_form.php
    showPartDatesBoxes();
    $(document).on('change', '#id_numparts', function () {
        showPartDatesBoxes();
    });

    // Activate simple dataTables
    if ($("#dataTable").length > 0) {
        $("#dataTable").dataTable();
    }

    // Configure datatables language settings
    if (typeof M.str.turnitintooltwo !== 'undefined') {
        var dataTablesLang = {
            "sProcessing": M.str.turnitintooltwo.sprocessing,
            "sZeroRecords": M.str.turnitintooltwo.szerorecords,
            "sInfo": M.str.turnitintooltwo.sinfo,
            "sSearch": M.str.turnitintooltwo.ssearch,
            "sLengthMenu": M.str.turnitintooltwo.slengthmenu,
            //"sInfoEmpty": M.str.turnitintooltwo.semptytable,
            "oPaginate": {
                "sNext": M.str.turnitintooltwo.snext,
                "sPrevious": M.str.turnitintooltwo.sprevious
            }
        };
    }

    // Activate datatable tabs on submission inbox
    if ($("#tabs").length > 0) {
        $("#tabs").tabs( {
            "show": function(event, ui) {
                var table = $.fn.dataTable.fnTables(true);
                if ( table.length > 0 ) {
                    $(table).dataTable().fnAdjustColumnSizing();
                }
            }
        });
    }

    // Configure the datatable for adding/removing enrolled tutors/students to a Turnitin course
    if ($('.enrolledMembers').length > 0) {
        $('.enrolledMembers').dataTable({
            "bProcessing": true,
            "sAjaxSource": "ajax.php",
            "aoColumnDefs": [
                {"bSortable": false, "sClass": "centered_cell", "aTargets": [0]},
                {"sClass": "left", "aTargets": [1]}
            ],
            "oLanguage": dataTablesLang,
            "fnServerData": function ( sSource, aoData, fnCallback ) {
                $.ajax({
                    "dataType": 'json',
                    "type": "POST",
                    "url": sSource,
                    "data": {action: "get_members", assignment: $('#assignment_id').html(), role: $('#user_role').html()},
                    "success": function(result) {
                        fnCallback(result);
                    },
                    "error": function(data, response) {
                        $('.dataTables_processing').attr('style', 'visibility: hidden');
                        $('.dataTables_empty').html(M.str.turnitintooltwo.membercheckerror);
                    }
                });
            }
        });
    }

    // Configure the datatables on the submission inbox, a seperate datatable is shown for each part.
    // There are tabs to toggle which part table is displayed.

    // Define column definitions as there can be different number of columns
    var submissionsDataTableColumns = [];
    var visibleCols = [];
    var noOfColumns = $('table.submissionsDataTable th').length / $('table.submissionsDataTable').length;
    var showOrigReport = ($('table.submissionsDataTable th.creport').length > 0) ? true : false;
    var useGrademark = ($('table.submissionsDataTable th.cgrade').length > 0) ? true : false;
    var multipleParts = ($('table.submissionsDataTable th.coverallgrade').length > 0) ? true : false;
    for (var i=0; i < noOfColumns; i++) {
        if (i == 2 || i == 3) {
            submissionsDataTableColumns.push(null);
            visibleCols.push(true);
        } else if (i == 4) {
            submissionsDataTableColumns.push({"sClass": "right"});
            visibleCols.push(true);
        } else if (i == 6 || (i == 8 && showOrigReport) || ((i == 8 && !showOrigReport) || (i == 10 && useGrademark))) {
            submissionsDataTableColumns.push({"sClass": "right", "iDataSort": i-1, "sType":"numeric"});
            visibleCols.push(true);
        } else if (i == 1 || ((i >= 7 && !showOrigReport && !useGrademark)
                                || (i >= 9 && ((!showOrigReport && useGrademark) || (showOrigReport && !useGrademark))) 
                                || (i >= 11 && showOrigReport && useGrademark))) {
            submissionsDataTableColumns.push({"sClass": "center", "bSortable": false});
            visibleCols.push(true);
        } else if ((i == 0) || (i == 5) || (i == 7 && showOrigReport) || ((i == 7 && !showOrigReport) || (i == 9 && useGrademark))) {
            submissionsDataTableColumns.push({"bVisible": false});
            visibleCols.push(false);
        }
    }

    var partTables = [];
    var refreshRequested = [];
    $('table.submissionsDataTable').each(function() {

        var part_id = $(this).attr("id");
        refreshRequested[part_id] = 0;

        partTables[part_id] = $('table#'+part_id).dataTable({
            "bProcessing": true,
            "aoColumns": submissionsDataTableColumns,
            "aaSorting": [[ 2, "asc" ],[ 4, "asc" ]],
            "sAjaxSource": "ajax.php",
            "oLanguage": dataTablesLang,
            "sDom": "r<\"top navbar\"lf><\"dt_pagination\"pi>t<\"bottom\"><\"dt_pagination\"pi>",
            "fnServerData": function ( sSource, aoData, fnCallback ) {
                $.ajax({
                    "dataType": 'json',
                    "type": "POST",
                    "url": sSource,
                    "data": {action: "initialise_redraw"},
                    "success": function(result) {
                        disableEditingText(part_id);
                        // We need to force showing of loading bar as if we place fnCallback after the table is populated it is wiped when refreshing
                        fnCallback(result);
                        $('#'+part_id+"_processing").attr('style', 'visibility: visible');
                        getSubmissions(partTables[part_id], $('#assignment_id').html(), part_id, 0, refreshRequested[part_id], 0);
                    }
                });
            },
            "bStateSave": true,
            "fnStateSave": function (oSettings, oData) {
                try {
                    localStorage.setItem( part_id+'DataTables', JSON.stringify(oData) );
                } catch ( e ) {
                }
            },
            "fnStateSaveParams": function(oSettings, oData) {
                oData.abVisCols = visibleCols;
            },
            "fnStateLoad": function (oSettings) {
                try {
                    return JSON.parse( localStorage.getItem(part_id+'DataTables') );
                } catch ( e ) {
                }
            },
            "fnStateLoadParams": function(oSettings, oData) {
                oData.abVisCols = visibleCols;
            },
            "fnDrawCallback":  function( oSettings ) {
                initialiseDVLaunchers("all", 0, part_id, 0);
                initialiseRefreshRow("all", 0, part_id, 0);
                initialiseUploadBox("all", 0, 0, 0);
                initialiseZipDownloads(part_id);
                initialiseCheckboxes(0, part_id);
                initialiseUnanoymiseForm("all", 0, 0);
            }
        });
    });

    $('table.submissionsDataTable').each(function() {
        var part_id = $(this).attr("id");

        // Populate Peermark Section of Part Details
        refreshPeermarkAssignments(part_id, 0);
    });

    if ($('.messages_amount').length > 0) {
        refreshUserMessages();
    }

    // Reposition links/divs
    var tii_table_functions = $("#tii_table_functions").html();
    $('#tii_table_functions').remove();
    $('.dataTables_length').after(tii_table_functions);
    $('.messages_inbox').show();
    $('.refresh_link').show();

    var zip_downloads = $("#zip_downloads");
    $('#zip_downloads').remove();
    $('.dataTables_length').after(zip_downloads);

    if ($("#user_role").html() == "Learner") {
        $(".dataTables_length, .dataTables_filter, .dt_pagination").hide();
    }

    // When the refresh submissions link is clicked, the data in each datatable needs to be reloaded
    $(".refresh_link").click(function () {
        $(this).hide();
        $('table.submissionsDataTable').each(function() {
            refreshRequested[$(this).attr("id")] = 1;
            partTables[$(this).attr("id")].fnReloadAjax();
            partTables[$(this).attr("id")].fnStandingRedraw();
        });
        return false;
    });

    // Show the Turnitin user agreement if necessary
    if ($(".turnitin_ula").length > 0) {
        $('#id_submitbutton').attr('disabled', 'disabled');
        $('.submission_form_container').attr('style', 'display:none;');

        $(window).on("message", function(ev) {
            var message = typeof ev.data === 'undefined' ? ev.originalEvent.data : ev.data;
            if (message === "turnitin_eula_declined") {
                window.parent.$('.upload_box').colorbox.close();
            } else {
                window.parent.$('.upload_box').data('launchEula', 0);
                window.parent.$('.upload_box').colorbox.resize({
                    width: "80%",
                    height: "80%"
                });
            }

            $('iframe.cboxIframe').attr('src', $('iframe.cboxIframe').attr('src'));
        });
    }

    $('.turnitin_ula input[type="submit"]').click(function() {
        $(this).hide();
        $(this).parent().parent().parent().find("p").hide();
        window.parent.$('.upload_box').colorbox.resize({
            width: "800px",
            height: "565px"
        });
    });

    // Enrol all students link on the enrolled students page
    $(".enrol_link").click(function () {
        $("#enrolling_error").hide();
        $(".enrol_link").hide();
        $(".enrolling_container").show();
        $.ajax({
            type: "POST",
            url: "ajax.php",
            dataType: "html",
            data: {action: "enrol_all_students", assignment: $('#assignment_id').html(), sesskey: M.cfg.sesskey},
            success: function(data) {
                window.location.href = window.location.href;
            },
            error: function(data, response) {
                $(".enrol_link").show();
                $(".enrolling_container").hide();
                $("#enrolling_error").show();
            }
        });
    });

    // Open an iframe light box containing the Rubric Manager
    if ($('.rubric_manager_launch').length > 0) {
        $('.rubric_manager_launch').colorbox({
            iframe:true, width:"832px", height:"682px", opacity: "0.7", className: "rubric_manager", transition: "none",
            onLoad: function() {
                lightBoxCloseButton();
                getLoadingGif();
            },
            onCleanup:function() {
                hideLoadingGif();
                // Refresh Rubric drop down in add/update form
                if ($(this).attr("id") != 'rubric_manager_inbox_launch') {
                    refreshRubricSelect();
                }
                $('#tii_close_bar').remove();
            }
        });
    }

    // Open an iframe light box containing the Rubric View
    if ($('.rubric_view_launch').length > 0) {
        $('.rubric_view_launch').colorbox({
            iframe:true, width:"832px", height:"682px", opacity: "0.7", className: "rubric_view", transition: "none",
            onLoad: function() {
                lightBoxCloseButton();
                getLoadingGif();
            },
            onCleanup: function() {
                $('#tii_close_bar').remove();
                hideLoadingGif();
            }
        });
    }

    // Show warning when changing the rubric linked to an assignment
    $('#id_rubric, #id_plagiarism_rubric').focus(function () {
        if ($('input[name="instance"]').val() != '' && $('input[name="rubric_warning_seen"]').val() != 'Y') {
            if (confirm(M.str.turnitintooltwo.changerubricwarning)) {
                $('input[name="rubric_warning_seen"]').val('Y');
            }
        }
    });

    // Open an iframe light box containing the Quickmark Manager
    if ($('.quickmark_manager_launch').length > 0 || $('.plagiarism_turnitin_quickmark_manager_launch').length > 0) {
        $('.quickmark_manager_launch, .plagiarism_turnitin_quickmark_manager_launch').colorbox({
            iframe:true, width:"700px", height:"432px", opacity: "0.7", className: "quickmark_manager", transition: "none",
            onLoad: function() {
                lightBoxCloseButton();
                getLoadingGif();
            },
            onCleanup: function() {
                $('#tii_close_bar').remove();
                hideLoadingGif();
            }
        });
    }

    // Open an iframe light box containing the Peermark Manager
    if ($('.peermark_manager_launch').length > 0) {
        $('.peermark_manager_launch').colorbox({
            iframe:true, width:"802px", height:"772px", opacity: "0.7", className: "peermark_manager", transition: "none",
            onLoad: function() {
                lightBoxCloseButton();
                getLoadingGif();
            },
            onCleanup:function() {
                $('#tii_close_bar').remove();
                hideLoadingGif();
            },
            onClosed:function() {
                var idStr = $(this).attr("id").split("_");
                refreshPeermarkAssignments(idStr[2], 1);
            }
        });
    }

    // Open an iframe light box containing the Peermark Reviews
    if ($('.peermark_reviews_launch').length > 0) {
        $('.peermark_reviews_launch').colorbox({
            iframe:true, width:"802px", height:"772px", opacity: "0.7", className: "peermark_reviews", transition: "none",
            onLoad: function() {
                lightBoxCloseButton();
                getLoadingGif();
            },
            onCleanup: function() {
                $('#tii_close_bar').remove();
                hideLoadingGif();
            }
        });
    }

    // Open an iframe light box containing the turnitin message inbox
    if ($(".messages_inbox").length > 0) {
        $(".messages_inbox").colorbox({
            iframe:true, width:"772px", height:"772px", opacity: "0.7", className: "messages", transition: "none", closeButton: false,
            onLoad: function() {
                lightBoxCloseButton();
                getLoadingGif();
            },
            onCleanup: function() {
                $('#tii_close_bar').remove();
                hideLoadingGif();
            },
            onClosed:function() {
                refreshUserMessages();
            }
        });
    }

    // Open the DV in a new window in such a way as to not be blocked by popups.
    $(document).on('click', '.default_open, .origreport_open, .grademark_open', function() {
        var proceed = true;
        if ($(this).hasClass('graded_warning')) {
            if (!confirm(M.str.turnitintooltwo.resubmissiongradewarn)) {
                proceed = false;
            }
        }

        if (proceed) {
            var idStr = $(this).attr("id").split("_");
            var url = $('#'+idStr[0]+'_url_'+idStr[1]).html()+'&viewcontext=box&do='+idStr[0]+'&submissionid='+idStr[1]+'&sesskey='+M.cfg.sesskey;
            var dvWindow = window.open('about:blank', 'dv_'+idStr[1]);
            var width = $(window).width();
            var height = $(window).height();
            dvWindow.document.write('<title>Document Viewer</title>');
            dvWindow.document.write('<style>html, body { margin: 0; padding: 0; border: 0; }</style>');
            dvWindow.document.write('<frameset><frame id="dvWindow" name="dvWindow"></frame></frameset>');
            dvWindow.document.getElementById('dvWindow').src = url;
            dvWindow.document.close();
            if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
                // beforeunload event does not work in Safari.
                $(dvWindow).bind('unload', function() {
                    refreshInboxRow(idStr[0], idStr[1], idStr[2], idStr[3]);
                });
            } else {
                $(dvWindow).bind('beforeunload', function() {
                    refreshInboxRow(idStr[0], idStr[1], idStr[2], idStr[3]);
                });
            }
        }
    });

    if ($("#id_rubric, #id_plagiarism_rubric").length > 0) {
        refreshRubricSelect();
    }

    // Override any theme that puts a background on the html element which gets set on an iframe
    if (self != top && $('#view_context').html() == 'box') {
        $('html').css('background', 'none');
    } else if (self != top && $('#view_context').html() == 'box_solid') {
        $('html').css('background', '#FFF');
    }

    if ($('.editable_text').length > 0) {
        $.fn.editable.defaults.mode = 'inline';
        $.fn.editable.defaults.url = 'ajax.php';
        $.fn.editable.defaults.onblur = 'submit';
        $.fn.editable.defaults.showbuttons = false;
        $.fn.editable.defaults.ajaxOptions = {
            dataType: 'json'
        }

        $('.editable_text').editable({
            validate: function(value) {
                if ($(this).attr('id').indexOf("marks_") >= 0 && (Math.floor(value) != value || !$.isNumeric(value) || value.indexOf(".") != -1)) {
                    return M.str.turnitintooltwo.maxmarkserror;
                }
            },
            success: function(response, newValue) {
                if(!response.success) {
                    return response.msg;
                } else if (response.field == "maxmarks") {
                    $('#refresh_'+response.partid).click();
                }
            }
        });

        if ( $('#export_options').hasClass('tii_export_options_hide') ) {
            $('#export_options').hide();
            $('.export_data').append('<span class="empty-dash">--</span>');
        }

        $('.editable_postdue').on("click", function() {
            var $this = $(this);
            $.ajax({
                type: "POST",
                url: "ajax.php",
                dataType: "json",
                data: {action: 'check_anon', assignment: $('#assignment_id').html()},
                success: function(data) {
                    $this.data('anon', data['anon']);
                    $this.data('submitted', data['submitted']);
                }
            });
        });

        var theDate = new Date();
        $('.editable_date').editable({
            'type': 'combodate',
            'format': 'YYYY-MM-DD HH:mm',
            'viewformat': 'D MMM YYYY, HH:mm',
            'template': 'D MMM YYYY  HH:mm',
            'combodate': {
                'minuteStep': 1,
                'minYear': 2000,
                'maxYear': theDate.getFullYear()+2,
                'smartDays': true
            },
            validate: function(value) {
                if( value.format("X") < moment().unix() && 
                    $(this).hasClass('editable_postdue') &&
                    $(this).data('anon') == 1 &&
                    $(this).data('submitted') == 1 )
                {
                    if ( ! confirm(M.str.turnitintooltwo.disableanonconfirm)) { 
                        $('.editable-open').editableContainer('hide');

                        // Validation only fails if string is returned (We need a string).
                        return ' ';
                    }
                }
            },
            success: function(response, newValue) {
                if(!response.success) {
                    return response.msg;
                } else {
                    $('#refresh_'+response.partid).click();

                    if (response.export_option == "tii_export_options_hide") {
                        $('#export_options').hide();
                        $('.export_data').append('<span class="empty-dash">--</span>');
                    } else {
                        $('.empty-dash').remove();
                        $('#export_options').show();
                    }
                }
            }
        });

        $('.editable_date').click(function() {
            if ($(this).hasClass('editable-disabled')) {
                return false;
            }
        });

        // Disable other editable fields when an editable form is opened
        $('.editable_date, .editable_text').on('shown', function(e, editable) {
            var current = ($(this).prop('id'));
            $('.editable_date, .editable_text').not('#'+current).editable('disable');
        });

        // Enable other editable fields when an editable form is closed
        $('.editable_date, .editable_text').on('hidden', function() {
            var current = ($(this).prop('id'));
            $('.editable_date, .editable_text').not('#'+current).editable('enable');
        });
    }

    $('#inbox_form form, .launch_form form').submit();

    // Update the DB value for EULA accepted
    function userAgreementAccepted( user_id ){
        $.ajax({
            type: "POST",
            url: "ajax.php",
            dataType: "json",
            data: {action: 'acceptuseragreement', user_id: user_id},
            success: function(data) {
                window.location.href = window.location.href;
            }
        });
    }

    // Enable the editing fields in the inbox parts table
    function enableEditingText(part_id) {
        $('#tabs-'+part_id+' .editable_date, #tabs-'+part_id+' .editable_text').editable('enable');
    }

    // Disable the editing fields in the inbox parts table
    function disableEditingText(part_id) {
        $('#tabs-'+part_id+' .editable_date, #tabs-'+part_id+' .editable_text').editable('disable');
    }

    function getLoadingGif() {
        var img = '<div class="loading_gif"></div>';
        $('#cboxOverlay').after(img);
        var top = $(window).scrollTop() + ($(window).height() / 2);
        $('.loading_gif').css('top', top+'px');
    }

    function hideLoadingGif() {
        $('.loading_gif').remove();
    }

    function getSubmissions(table, assignment_id, part_id, start, refresh_requested, total) {
        $.ajax({
            "dataType": 'json',
            "type": "POST",
            "url": "ajax.php",
            "async": true,
            "data": {action: "get_submissions", assignment: assignment_id, part: part_id, start: start,
                        refresh_requested: refresh_requested, sesskey: M.cfg.sesskey, total: total},
            "success": function(result) {
                eval(result);
                start = result.end;

                if (result.aaData.length > 0) {
                    table.fnAddData(result.aaData);
                }

                if (result.end < result.total) {
                    getSubmissions(table, assignment_id, part_id, start, refresh_requested, result.total);
                } else {
                    $('#'+part_id+"_processing").attr('style', 'visibility: hidden');
                    $('#refresh_'+part_id).show();
                    enableEditingText(part_id);
                }
            },
            "error": function(data, response) {
                $('#'+part_id+"_processing").attr('style', 'visibility: hidden');
                $('.dataTables_empty').html(M.str.turnitintooltwo.tiisubmissionsgeterror);
            }
        });
    }

    // Get the rubrics belonging to a user from Turnitin and refresh menu accordingly
    function refreshRubricSelect() {
        var rubricElementId = ($('#id_rubric').length) ? '#id_rubric' : '#id_plagiarism_rubric';
        var currentRubric = $(rubricElementId).val();
        $.ajax({
            "dataType": 'json',
            "type": "POST",
            "url": "../mod/turnitintooltwo/ajax.php",
            "data": {action: "refresh_rubric_select", assignment: $('input[name="instance"]').val(),
                        modulename: $('input[name="modulename"]').val(), course: $('input[name="course"]').val()},
            success: function(data) {
                $($(rubricElementId)).empty();
                var options = data;
                $.each(options, function(i, val) {
                    $($(rubricElementId)).append($('<option>', {
                        value: i,
                        text : val
                    }));
                });
                $(rubricElementId+' option[value="'+currentRubric+'"]').attr("selected","selected");
            }
        });
    }

    // Refresh the number of messages in the user's Turnitin inbox
    function refreshUserMessages() {
        $('.messages_loading').show();
        $('.messages_amount').html('');

        $.ajax({
            "dataType": 'html',
            "type": "POST",
            "url": "ajax.php",
            "data": {action: "refresh_user_messages", assignment: $('#assignment_id').html()},
            success: function(data) {
                $('.messages_loading').hide();
                $('.messages_amount').html(data);
            }
        });
    }

    // Hide Peermark assignments for refreshing
    function resetPeermarkSection(part_id) {
        $('#tabs-'+part_id+' .toggle_peermarks').hide();
        $('#tabs-'+part_id+' .peermark_count').html('');
        $('#tabs-'+part_id+' .peermark_loading').show();
        $('#tabs-'+part_id+' .peermark_assignments_container').hide();
    }

    // Refresh the Peermark Assignments from Turnitin and show in Part Details section of inbox
    function refreshPeermarkAssignments(part_id, refresh_requested) {

        var user_role = ($('.peermark_manager_launch').length > 0) ? 'Instructor' : 'Learner'

        if ($('#tabs-'+part_id+' .peermark_assignments_container').length > 0) {

            resetPeermarkSection(part_id);

            $.ajax({
                "dataType": 'json',
                "type": "POST",
                "url": "ajax.php",
                "data": {action: "refresh_peermark_assignments", assignment: $('#assignment_id').html(),
                            part: part_id, refresh_requested: refresh_requested, sesskey: M.cfg.sesskey},
                success: function(data) {
                    eval(data);
                    $('#tabs-'+part_id+' .peermark_assignments_container').html(data.peermark_table);

                    $('#tabs-'+part_id+' .peermark_loading').hide();
                    $('#tabs-'+part_id+' .peermark_count').html(data.no_of_peermarks);

                    if (data.no_of_peermarks > 0) {
                        $('#tabs-'+part_id+' .toggle_peermarks').show();
                    } else {
                        $('#tabs-'+part_id+' .toggle_peermarks').hide();
                    }

                    if ((data.no_of_peermarks > 0 && user_role == 'Instructor') || (data.peermarks_active && user_role == 'Learner')) {
                        $('#tabs-'+part_id+' .row_peermark_reviews').show();
                    }

                    if ($.cookie('show_peermarks_'+$('#assignment_id').html()) == "true" && data.no_of_peermarks > 0) {
                        $('.show_peermarks_'+$('#assignment_id').html()).hide();
                        $('.hide_peermarks_'+$('#assignment_id').html()).show();
                        $('.peermark_assignments_container').slideDown();
                    } else {
                        $('.show_peermarks_'+$('#assignment_id').html()).show();
                        $('.hide_peermarks_'+$('#assignment_id').html()).hide();
                        $('.peermark_assignments_container').slideUp();
                    }
                }
            });
        }
    }

    // Show light box with form to reveal the student's name on an anonymised submission
    function initialiseUnanoymiseForm(scope, assignment_id, submission_id) {
        var identifier = 'a.unanonymise';
        if (scope == "row") {
            identifier = '#submission_'+submission_id;
        }
        $(identifier).colorbox({
            inline:true, width:"50%", top: "100px", height:"260px", opacity: "0.7", className: "tii_unanonymise_reveal_form",
            onComplete : function() {
                var idStr = $(this).attr("id").split("_");
                if (submission_id == 0 || submission_id == undefined) {
                    var submission_id = idStr[1];
                }
                if (assignment_id == 0) {
                    assignment_id = $('#assignment_id').html();
                }
                $("#submission_id").html(submission_id);
                $('#cboxLoadedContent .unanonymise_form').show();
                $('#id_reveal').unbind("click");
                $('#id_reveal').click(function() {
                    $.ajax({
                        "dataType": 'json',
                        "type": "POST",
                        "url": "ajax.php",
                        "data": {action: "reveal_submission_name", assignment: assignment_id, submission_id: submission_id,
                                    reason: encodeURIComponent($("#id_anonymous_reveal_reason").val()), sesskey: M.cfg.sesskey},
                        success: function(data) {
                            eval(data);
                            if (data.status == "success") {
                                parent.$.fn.colorbox.close();
                                $('#submission_'+submission_id).attr('href', M.cfg.wwwroot+"/user/view.php?id="+data.userid+"&course="+data.courseid);
                                $('#submission_'+submission_id).html(data.name);
                                $('#submission_'+submission_id).removeClass('unanonymise cboxElement');
                            } else {
                                var current_msg = $('#unanonymise_desc').html;
                                $('#unanonymise_desc').html(current_msg+" "+data.msg);
                            }
                        }
                    });
                });
            },
            onCleanup: function() {
                $('.unanonymise_form').hide();
            }
        });
    }

    function initialiseUploadBox(scope, submission_id, part_id, user_id) {
        var identifier = ".upload_box";
        if (scope == "row") {
            identifier = "#upload_"+submission_id+"_"+part_id+"_"+user_id;
        }

        var colorBoxWidth = "700px";
        var colorBoxHeight = "90px";

        $(identifier).colorbox({
            onComplete: function() {
                if ( $('.upload_box').data('launchEula') === 0 ) {
                    window.parent.$('.upload_box').colorbox.resize({
                       width: "80%",
                       height: "80%"
                    });
                }
            },
            onLoad: function() {
                getLoadingGif();
                lightBoxCloseButton();
            },
            onClosed: function() { hideLoadingGif(); },
            onCleanup:function() {
                hideLoadingGif();
                var idStr = $(this).attr("id").split("_");
                refreshInboxRow("upload", idStr[1], idStr[2], idStr[3]);

                $('#tii_close_bar').remove();
            },
            iframe:true, width:colorBoxWidth, height:colorBoxHeight, opacity: "0.7", className: "upload", transition: "none"
        });
    }

    // Initialise the events to open the zip files contained in the part details
    // information table:
    // Inbox in XLS format
    // ZIP containing all files as PDFs
    // ZIP containing all files in original format
    function initialiseZipDownloads(part_id) {
        // Unbind the event first to stop it being binded multiple times
        $('#tabs-'+part_id+' .orig_zip_open, #tabs-'+part_id+' .pdf_zip_open, #tabs-'+part_id+' .xls_inbox_open').unbind("click");

        // Open a spreadsheet or a zip file containing all the relevant data
        $('#tabs-'+part_id+' .orig_zip_open, #tabs-'+part_id+' .pdf_zip_open, #tabs-'+part_id+' .xls_inbox_open').click(function() {
            var idStr = $(this).attr("id").split("_");
            downloadZipFile(idStr[0]+"_"+idStr[1], idStr[2]);
        });

        // Open an iframe light box which requests all the submissions as pdfs from Turnitin
        $('#tabs-'+part_id+' .downloadpdf_box').colorbox({
            iframe:true, width:"40%", height:"60%", opacity: "0.7", className: "downloadpdf_window", transition: "none",
            onLoad: function() {
                lightBoxCloseButton();
                getLoadingGif();
            },
            onCleanup: function() {
                $('#tii_close_bar').remove();
                hideLoadingGif();
            },
            onClosed: function() {
                refreshUserMessages();
            }
        });

        // Open an iframe light box which requests selected submissions as pdfs from Turnitin
        $(document).on('click', '#tabs-'+part_id+' .gmpdfzip_box', function(e) {
            $(this).colorbox({
                open:true,iframe:true, width:"786px", height:"300px", opacity: "0.7", className: "gmpdfzip_window", transition: "none",
                href: function() {
                            var submission_ids = "";
                            var i = 0;

                            $('.inbox_checkbox:checked').each(function(i){
                                submission_ids += "&submission_id"+i+"="+$(this).val();
                                i++;
                            });

                            return $(this).attr('href')+submission_ids;
                },
                onLoad: function() { getLoadingGif(); },
                onCleanup: function() { hideLoadingGif(); },
                onClosed: function() {
                    refreshUserMessages();
                }
            });
            return false;
        });
    }

    function lightBoxCloseButton() {
        $('body').append('<div id="tii_close_bar"><a href="#" onclick="$.colorbox.close(); return false;">' + M.str.turnitintooltwo.closebutton + '</a></div>');
    }

    function initialiseHiddenZipDownloads(part_id) {
        // Unbind the event first to stop it being binded multiple times
        $('#tabs-'+part_id+' .origchecked_zip_open').unbind("click");
        // Seperate binder for hidden zip file link
        $('#tabs-'+part_id+' .origchecked_zip_open').click(function() {
            var idStr = $(this).attr("id").split("_");
            downloadZipFile(idStr[0]+"_"+idStr[1], idStr[2]);
            return false;
        });
    }


    function initialiseRefreshRow(scope, submission_id, part_id, user_id) {
        var identifier = ".refresh_row .fa-refresh";
        if (scope == "row") {
            identifier = "#refreshrow_"+submission_id+'_'+part_id+"_"+user_id+" .fa-refresh";
        }

        // Unbind the event first to stop it being binded multiple times
        $(identifier).unbind("click");

        $(identifier).click(function() {
            $(this).hide();
            $(this).siblings('.fa-spinner').css("display","inline-block");
            var idStr = $(this).parent().attr("id").split("_");
            refreshInboxRow(idStr[0], idStr[1], idStr[2], idStr[3]);
        });
    }

    // Initialise the events to open the document viewer as the links are loaded after the page
    function initialiseDVLaunchers(scope, submission_id, part_id, user_id) {
        var identifier = '#'+part_id+' .download_original_open';//#'+part_id+' .origreport_open, #'+part_id+' .grademark_open, 
        if (scope == "row") {
            identifier = '#downloadoriginal_'+submission_id+'_'+part_id+'_'+user_id;
            //#origreport_'+submission_id+'_'+part_id+'_'+user_id+', #grademark_'+submission_id+'_'+part_id+'_'+user_id+', 
        }

        // Unbind the event first to stop it being binded multiple times
        $(identifier).unbind("click");

        $(identifier).click(function() {
            var idStr = $(this).attr("id").split("_");
            // Don't open OR DV if score is pending.
            if (!$(this).children('.score_colour').hasClass('score_colour_')) {
                openDV(idStr[0], idStr[1], idStr[2], idStr[3]);
            }
        });
    }

    // Put the form in to the submissions table row and submit it.
    // This will download the relevant zip file
    function downloadZipFile(downloadtype, part_id) {
        var submission_ids = [];
        if (downloadtype == "origchecked_zip" || downloadtype == "gmpdf_zip") {
            $('.inbox_checkbox:checked').each(function(i){
                submission_ids[i] = $(this).val();
            });
        }

        $.ajax({
            type: "POST",
            url: "ajax.php",
            dataType: "html",
            data: {action: downloadtype, assignment: $('#assignment_id').html(), part: part_id, submission_ids: submission_ids},
            success: function(data) {
                $("#"+downloadtype+"_form_"+part_id).html(data);
                $("#"+downloadtype+"_form_"+part_id).children("form").submit();
                $("#"+downloadtype+"_form_"+part_id).html("");
            }
        });
    }

    // Open the document viewer within a frame in a new tab
    function openDV(dvtype, submission_id, part_id, user_id) {
        var proceed = true;
        if ($('#grademark_'+submission_id+'_'+part_id+'_'+user_id).hasClass('graded_warning') && dvtype != 'downloadoriginal') {
            if (!confirm(M.str.turnitintooltwo.resubmissiongradewarn)) {
                proceed = false;
            }
        }

        if (proceed) {
            $.ajax({
                type: "POST",
                url: "ajax.php",
                dataType: "html",
                data: {action: dvtype, assignment: $('#assignment_id').html(), submission: submission_id},
                success: function(data) {
                    $("#"+dvtype+"_form_"+submission_id).html(data);
                    if (dvtype == "downloadoriginal") {
                        $("#"+dvtype+"_form_"+submission_id).children("form").submit();
                    } else {
                        $("#"+dvtype+"_form_"+submission_id).children("form").on("submit", function(event) {
                            dvWindow = window.open('', 'dv_'+submission_id);
                            dvWindow.document.write('<frameset><frame id="dvWindow" name="dvWindow"></frame></frameset>');
                            dvWindow.document.close();
                            $(dvWindow).bind('beforeunload', function() {
                                refreshInboxRow(dvtype, submission_id, part_id, user_id);
                            });
                        });
                        $("#"+dvtype+"_form_"+submission_id).children("form").submit();
                    }
                    $("#"+dvtype+"_form_"+submission_id).html("");
                }
            });
        }
    }

    // Initiate a nothing submission
    function submitNothing( user_id, part_id ) {
        $("#submitnothing_0_"+part_id+"_"+user_id+" img").attr('src','pix/loader.gif');
        $.ajax({
            type: "POST",
            url: "ajax.php",
            dataType: "json",
            data: {action: "submit_nothing", assignment: $('#assignment_id').html(),
                    part: part_id, user: user_id, sesskey: M.cfg.sesskey},
            success: function(data) {
                eval(data);
                $.cookie( 'submitnothingaccept', true, { expires: 365 } );
            },
            error: function(data) {
                $("#submitnothing_0_"+part_id+"_"+user_id+" img").attr('src','pix/icon-edit-grey.png');
                $("#submitnothing_0_"+part_id+"_"+user_id).removeClass('disabled');
                alert( data.responseText );
            },
            complete: function() {
                refreshInboxRow( 'submitnothing', 0, part_id, user_id );
            }
        });
    }

    // Refresh a row in the inbox after a submission has been made or DV closed
    function refreshInboxRow(link, submission_id, part_id, user_id) {
        $.ajax({
            type: "POST",
            url: "ajax.php",
            dataType: "json",
            data: {action: "refresh_submission_row", assignment: $('#assignment_id').html(),
                    part: part_id, user: user_id, sesskey: M.cfg.sesskey},
            success: function(data) {
                eval(data);
                var i = 0;
                if (submission_id == 0) {
                    link += "_0";
                    submission_id = data.submission_id;
                } else if (data.submission_id == null && submission_id != 0) {
                    link = link+"_"+submission_id;
                } else {
                    link = link+"_"+data.submission_id;
                }
                // Show export links.
                if (submission_id != 0) {
                    $('#export_links').removeClass('hidden_class');
                }

                // Delete the row and re-add.
                oTable = $('table#'+part_id).dataTable();
                var tr = $("#"+link+"_"+part_id+'_'+user_id).parent().parent();
                var rowindex = tr.index();
                oTable.fnDeleteRow(tr);
                oTable.fnAddData(data.row);

                initialiseUploadBox("row", data.submission_id, part_id, user_id);
                initialiseDVLaunchers("row", data.submission_id, part_id, user_id);
                initialiseRefreshRow("row", data.submission_id, part_id, user_id);
                initialiseCheckboxes(data.submission_id, part_id);
                initialiseUnanoymiseForm("row", $('#assignment_id').html(), data.submission_id);
            }
        });
    }

    // Show download links when checkboxes have been ticked
    function initialiseCheckboxes(submission_id, part_id) {
        var identifier = 'input.inbox_checkbox';
        if (submission_id != 0) {
            identifier = 'check_'+submission_id;
        }
        $(document).on('click', identifier, function() {
            if ($('.inbox_checkbox:checked').length > 0) {
                $('#zip_downloads').slideDown();
                initialiseHiddenZipDownloads(part_id)
            } else {
                $('#tabs-'+part_id+' .origchecked_zip_open').unbind('click');
                $('#zip_downloads').slideUp();
            }
        });
    }

    // Show the date and marks options for the relevant number of parts when creating/editing assignment
    function showPartDatesBoxes() {
        for (var i = 0; i <= 5; i++) {
            if (i <= $("#id_numparts").val()) {
                $('fieldset[id$="partdates'+i+'"]').slideDown();
            } else {
                $('fieldset[id$="partdates'+i+'"]').slideUp();
            }
        }
    }
});