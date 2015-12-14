//var delData = [];
//var noRecords = 0;
var records;
var TableAdvanced = function () {

    var initTable1 = function() {

        /* LOAD TABLE DETAILS*/


        /* Formatting function for row details */
        function fnFormatDetails ( oTable, nTr )
        {
            row=records[nTr.id];
            console.log("Bot-"+JSON.stringify(records[nTr.id]));

            var aData = oTable.fnGetData( nTr );
            var sOut = '<table>';
            sOut += '<tr><td>Serial No:</td><td>'+row.serial_no+'</td> </tr>';
            sOut += '<tr><td>Lecture Date:</td><td>'+row.lec_date+'</td></tr>';
            sOut += '<tr><td>Leture Title:</td><td>'+row.lec_title+'</td></tr>';
            sOut += '<tr><td>Short Description:</td><td>'+row.short_desc+'</td></tr>';
            var vimeo_link = "";
            if(row.vimeo_link == "" || row.vimeo_link == null) {
                vimeo_link = "<span class='label label-sm label-danger'>ABSENT</span>";
            } else {
                vimeo_link = row.vimeo_link;
            }
            sOut += '<tr><td>Vimeo Link:</td><td>'+vimeo_link+'</td></tr>';
            sOut += '<tr><td>Youtube Link:</td><td>'+row.youtube_link+'</td></tr>';
            var dm_link = "";
            if(row.dailymotion_link == "" || row.dailymotion_link == null) {
                dm_link = "<span class='label label-sm label-danger'>ABSENT</span>";
            } else {
                dm_link = row.dailymotion_link;
            }
            sOut += '<tr><td>Dailymotion Link:</td><td>'+dm_link+'</td></tr>';
            thumb_html = "<img src='" + row.lec_thumbnail + "' width='50px' />";
            sOut += "<tr><td>SoundCloud Link:</td><td><textarea rows='2' cols='50'>"+row.soundcloud_link+"</textarea></td><td>Thumbnail: "+thumb_html + "</td></td></tr>";
            sOut += '<tr><td><a href="samaritan_edit_record.php?id='+ row.serial_no+'">Edit Record </a></td></tr>';
            sOut += '</table>';
            return sOut;
        }

        /*
         * Insert a 'details' column to the table
         */
        var nCloneTh = document.createElement( 'th' );
        var nCloneTd = document.createElement( 'td' );
        nCloneTd.innerHTML = '<span class="row-details row-details-close"></span>';

        $('#del_table thead tr').each( function () {
            this.insertBefore( nCloneTh, this.childNodes[0] );
        } );

        $('#del_table tbody tr').each( function () {
            this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
        } );

        /*
         * Initialize DataTables, with no sorting on the 'details' column
         */
        var oTable = $('#del_table').dataTable( {
            "aoColumnDefs": [
                {"bSortable": false, "aTargets": [ 0 ] }
            ],
            "aaSorting": [[1, 'asc']],
            "aLengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "iDisplayLength": 5,
        });

        jQuery('#del_table_wrapper .dataTables_filter input').addClass("form-control input-small"); // modify table search input
        jQuery('#del_table_wrapper .dataTables_length select').addClass("form-control input-small"); // modify table per page dropdown
        jQuery('#del_table_wrapper .dataTables_length select').select2(); // initialize select2 dropdown

        /* Add event listener for opening and closing details
         * Note that the indicator for showing which row is open is not controlled by DataTables,
         * rather it is done here
         */
        $('#del_table').on('click', ' tbody td .row-details', function () {
            var nTr = $(this).parents('tr')[0];
            if ( oTable.fnIsOpen(nTr) )
            {
                /* This row is already open - close it */
                $(this).addClass("row-details-close").removeClass("row-details-open");
                oTable.fnClose( nTr );
            }
            else
            {
                /* Open this row */
                $(this).addClass("row-details-open").removeClass("row-details-close");
                oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
            }
        });
    }



    return {

        //main function to initiate the module
        init: function () {

            jQuery.ajax({
                url: 'samaritan_data_async.php',
                success: function (data, status) {
                    //Lock UI
                    reloadBtn = jQuery('.portlet > .portlet-title > .tools > a.reload');
                    App.blockUI(jQuery(reloadBtn).closest(".portlet").children(".portlet-body"));

                    //Add code to load data into table (HTML)
                    data=JSON.parse(data);
                    console.log("count--"+parseInt(data.count));
                    noRecords = parseInt(data.count);
                    if(data.errorCode == '1'){
                        window.location.replace("samaritan_machine.php");
                    }
                    if(noRecords == 0)
                        return;

                    delData=data.data;
                    console.log("dddddd-"+JSON.stringify(delData));
                    records=delData;
                    tblBody = jQuery('#del_table_body');
                    tblBody.html(" ");
                    jQuery.each(delData, function(aa,bb) {
                        console.log("eeee--"+JSON.stringify(bb));

                        var record_version_text = "";
                        if(bb.live_flag == 1) {
                            record_version_text = "English Subtitles";

                        } else if(bb.live_flag == 0) {
                            record_version_text = "Live Version";

                        }

                        add = "<tr id='"+bb.id+"'><td>"+bb.id+"</td><td>"+bb.serial_no+"</td><td>"+bb.lec_title+"</td><td>"+bb.lec_date+"</td><td>"+record_version_text+"</td><td>"+"Valid"+"</td></tr>";

                        tblBody.append(add);

                    });
                    //Unlock UI
                    App.unblockUI(jQuery(reloadBtn).closest(".portlet").children(".portlet-body"));
                },
                async: false
            });






            if (!jQuery().dataTable) {
                return;
            }
            jQuery('.portlet > .portlet-title > .tools > a.reload').click();
            initTable1();

        }

    };

}();