@extends('admin/include/master')
@section('title') لوحة التحكم |  العملاء @endsection
@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
        <div class="box box-primary">   
            <div class="box-header with-border">
                <h3 class="box-title">كل العملاء</h3>
            </div>    
                    <div class="active tab-pane" id="activity">
                        <div class="table-responsive box-body">
                            <button style="margin-bottom: 10px;float:left;" class="btn btn-danger delete_all" data-url="{{ url('myusersDeleteAll') }}"><i class="fa fa-trash-o" aria-hidden="true"></i> حذف المحدد</button>
                            <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center;">الاسم </th>
                                            <th style="text-align:center;"> رقم الجوال </th>
                                            <th style="text-align:center;">  مشاهدة</th>
                                            <th style="text-align:center;"> تعطيل </th>
                                            <th style="text-align:center;"> تعديل </th>
                                            <th style="text-align:center;"> حذف</th> 
                                            <th width="50px"><input type="checkbox" id="master"></th>
                                        </tr>
                                    </thead>
                            
                                    <tbody> 
                                        @foreach($allusers as $user)
                                            <tr>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->phone}}</td>
                                                <td>
                                                    <a href='{{asset("adminpanel/users/".$user->id)}}' class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                </td>

                                                <td>
                                                {{ Form::open(array('method' => 'patch',"onclick"=>"return confirm('هل انت متاكد ؟!')",'files' => true,'url' =>'adminpanel/users/'.$user->id )) }}
                                                    <input type="hidden" name="suspensed" >
                                                    <button type="submit" class="btn btn-default">
                                                    @if($user->suspensed == 1) 
                                                    <i style="color:crimson" class="fa fa-lock" aria-hidden="true"></i> 
                                                    @else 
                                                    <i style="color:#1FAB89" class="fa fa-unlock" aria-hidden="true"></i> 
                                                    @endif
                                                    </button>
                                                {!! Form::close() !!}
                                                </td>
                                                <td>
                                                    <a href='{{asset("adminpanel/users/".$user->id."/edit")}}' class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                </td>

                                                <td>
                                                    {{ Form::open(array('method' => 'DELETE','id' => 'del'.$user->id,"onclick"=>"return confirm('هل انت متأكد ؟!')",'files' => true,'url' => array('adminpanel/users/'.$user->id))) }}
                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                    {!! Form::close() !!}
                                                </td>

                                                 <td><input type="checkbox" class="sub_chk" data-id="{{$user->id}}"></td>
                                            </tr>
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
