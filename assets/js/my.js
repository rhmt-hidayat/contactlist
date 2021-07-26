$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
    $("#data1").DataTable();
    $("#rm1").DataTable();
    $("#cp1").DataTable();
    $("#aux1").DataTable();

    //Initialize Select2 Elements
    $('.select2').select2();

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox();

    //Tooltip
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-tooltip="tooltip"]').tooltip();
});

$('#changePassword').on('show.bs.modal', function(e) {
    var userID = $(e.relatedTarget).data('id');
    var modal = $(this);

    modal.find('#userid').attr("value", userID);
});

$('#hapusData').on('show.bs.modal', function(e) {
    var userID = $(e.relatedTarget).data('id');
    var modal = $(this);

    modal.find('#userid-delete').attr("value", userID);
});

$(document).ready(function(){
    $('#project').change(function(){
        var id= $(this).val();
        // alert(id);
        $.ajax({
            url : "getMaterial",
            method : "POST",
            data : {id: id},
            async : true,
            dataType : 'json',
            success: function(data){
                 
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value='+data[i].kode_material+'>'+data[i].kode_material+'</option>';
                }
                $('#material').html(html);

            }
        });
        return false;
    }); 
     
});

function hasil()
{
    var total = $('#total_qty').val();
    var defect = $('#defect_qty').val();
    if (defect > total)
    {
        alert('Defect qty tidak boleh lebih besar dari Total qty !!');
        // $('#tampil').modal('show');
    }
}

function hasilSortir()
{
    var total = $('#total_qty').val();
    var sortir = $('#qty_sortir').val();
    if (sortir > total)
    {
        alert('Qty Sortir tidak boleh lebih besar dari Total qty !!');
        // $('#tampil').modal('show');
    }
}

function hasilNG()
{
    var total = $('#total_qty').val();
    var sortir = $('#qty_sortir').val();
    var ok = $('#qty_ok').val();
    var result;
    if (ok > total && sortir){
        alert('Qty OK tidak boleh lebih besar dari Total qty dan Qty Sortir !!');
    }
        result = sortir - ok;
        $('#qty_ng').val(result);
}