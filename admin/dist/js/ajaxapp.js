

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    $('#prodcat').change(function () 
    {
        var catval=$('#prodcat').val()
        console.log($('#prodcat').val());

        $.ajax({
        type: "post" ,
        url : '{{asset("adminpanel/reqproductads")}}' ,
        data : {
            cat_id: catval
        },
        success : function(data){
            $('#prodsubcat').html('<option value="0" disabled selected> اختارالفئة الفرعية </option>');
            console.log(data.length);
            if(data.length!=0)
            {
            $('#prodsubcat').prop("disabled", false);
            for (var i = 0; i < data.length; i++) {
            var option = '<option value="'+data[i].id+'">'+data[i].name+'</option>' ;
            $('#prodsubcat').append(option);}}
            else {
                $('#prodsubcat').html('<option value="0" disabled selected> اختارالفئة الفرعية</option>');
            }
        },
    });
  });