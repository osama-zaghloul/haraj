@extends('admin/include/master')
@section('title') لوحة التحكم |  التحويلات البنكية  @endsection
@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
        <div class="box box-primary">   
            <div class="box-header with-border">
                <h3 class="box-title">كل التحويلات </h3>
            </div>    
                    <div class="active tab-pane" id="activity">
                        <div class="table-responsive box-body">
                            <button style="margin-bottom: 10px;float:left;" class="btn btn-danger delete_all" data-url="{{ url('mytransferDeleteAll') }}"><i class="fa fa-trash-o" aria-hidden="true"></i> حذف المحدد</button>
                            <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center;">الاسم</th>
                                            <th style="text-align:center;">رقم الجوال</th>
                                            <th style="text-align:center;">البنك </th>
                                             <th style="text-align:center;">رقم الفاتورة </th>
                                            <th style="text-align:center;">مشاهدة</th>
                                            <th style="text-align:center;"> حذف</th> 
                                            <th width="50px"><input type="checkbox" id="master"></th>
                                        </tr>
                                    </thead>
                            
                                    <tbody> 
                                        @foreach($alltransfers as $transfer)
                                            <?php $userinfo = DB::table('members')->where('id',$transfer->user_id)->first(); ?>
                                            <tr>
                                                <td>
                                                <a href="{{asset('adminpanel/users/'.$userinfo->id)}}">{{$userinfo->name}}</a>
                                                </td>
                                                <td>{{$userinfo->phone}}</td>
                                                <td>{{$transfer->bank_name}}</td>
                                                <td>{{$transfer->bill_number}}</td>
                                                
                                                <td>
                                                    <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#modal-default{{$transfer->id}}">محتوى التحويل</button>
                                                </td>
                                                
                                                <td>
                                                    {{ Form::open(array('method' => 'DELETE',"onclick"=>"return confirm('هل انت متأكد ؟!')",'files' => true,'url' => array('adminpanel/transfers/'.$transfer->id))) }}
                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                    {!! Form::close() !!}
                                                </td>
                                                <td><input type="checkbox" class="sub_chk" data-id="{{$transfer->id}}"></td>
                                            </tr>

                                            <div class="modal fade" id="modal-default{{$transfer->id}}" style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span></button>
                                                        <h4 class="modal-title">محتوى التحويل</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img class="img-thumbail" style="width:100%;"  src="{{asset('users/images/'.$transfer->image)}}" alt="">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">اغلاق</button>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach
                                    </tbody> 
                                </table>
                        </div>
                    </div>
            </div>    
        </div>
        </div>
    </div>
</section>

    <script type="text/javascript">
        $(document).ready(function () {

            $('#master').on('click', function(e) {
            if($(this).is(':checked',true))  
            {
                $(".sub_chk").prop('checked', true);  
            } else {  
                $(".sub_chk").prop('checked',false);  
            }  
            });

            $('.delete_all').on('click', function(e) {
                var allVals = [];  
                $(".sub_chk:checked").each(function() {  
                    allVals.push($(this).attr('data-id'));
                });  


                if(allVals.length <=0)  
                {  
                    alert("حدد عنصر واحد ع الاقل ");  
                }  else {  
                    var check = confirm("هل انت متاكد؟");  
                    if(check == true){  
                        var join_selected_values = allVals.join(","); 
                        $.ajax({
                            url: $(this).data('url'),
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids='+join_selected_values,
                            success: function (data) {
                                if (data['success']) {
                                    $(".sub_chk:checked").each(function() {  
                                        $(this).parents("tr").remove();
                                    });
                                    alert(data['success']);
                                } else if (data['error']) {
                                    alert(data['error']);
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function (data) {
                                alert(data.responseText);
                            }
                        });


                    $.each(allVals, function( index, value ) {
                        $('table tr').filter("[data-row-id='" + value + "']").remove();
                    });
                    }  
                }  
            });


            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                onConfirm: function (event, element) {
                    element.trigger('confirm');
                }
            });

            $(document).on('confirm', function (e) {
                var ele = e.target;
                e.preventDefault();

                $.ajax({
                    url: ele.href,
                    type: 'DELETE',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        if (data['success']) {
                            $("#" + data['tr']).slideUp("slow");
                            alert(data['success']);
                        } else if (data['error']) {
                            alert(data['error']);
                        } else {
                            alert('Whoops Something went wrong!!');
                        }
                    },
                    error: function (data) {
                        alert(data.responseText);
                    }
                });
                return false;
            });
        });
    </script>

@endsection
