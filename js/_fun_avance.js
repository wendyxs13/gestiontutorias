function avance_ind(matri) {
    $('#resp_avance').html('<h5>&nbsp;&nbsp;&nbsp;Buscando información...</h5>');
    $.ajax({
        type: 'POST',
        url: '../../php/pro_avance.php',
        data: {con: 1, matri: matri},
        success: function (r) {
            //alert(r)
            if (r == 'new') {
                location.href = "form_inf_ind.php";
            } else {
                $.ajax({
                    type: 'POST',
                    url: '../../modulo/tutor/form_inf_ind_all.php',
                    data: {matri: matri},
                    success: function (r2) {
                        //alert(r2); 
                        $('#resp_avance').html(r2);
                        $('#resp_avance').scrollTop(0);
                    }
                });
            }
        }
    });
}