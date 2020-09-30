@extends('admin/include/master')
@section('title') لوحة التحكم |   البلاغات  @endsection
@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
        <div class="box box-primary">   
            <div class="box-header with-border">
                <h3 class="box-title">كل البلاغات </h3>
            </div>    
                    <div class="active tab-pane" id="activity">
                        <div class="table-responsive box-body">
                            <button style="margin-bottom: 10px;float:left;" class="btn btn-danger delete_all" data-url="{{ url('myreportDeleteAll') }}"><i class="fa fa-trash-o" aria-hidden="true"></i> حذف المحدد</button>
                            <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center;">صاحب البلاغ</th>
                                            <th style="text-align:center;">كود المنتج </th>
                                            <th style="text-align:center;">تاريخ البلاغ </th>
                                            <th style="text-align:center;">مشاهدة</th>
                                            <th style="text-align:center;"> حذف</th> 
                                            <th width="50px"><input type="checkbox" id="master"></th>
                                        </tr>
                                    </thead>
                            
                                    <tbody> 
                                        @foreach($allreports as $report)
                                            <?php $user = DB::table('members')->where('id',$report->user_id)->first();
                                            $item = DB::table('items')->where('id',$report->ad_num)->first();
                                            ?>
                                            <tr>
                                                <td><a href="{{asset('adminpanel/users/'.$user->id)}}">{{$user->name}}</a></td> 
                                                <td>

                                                    <a href="{{asset('adminpanel/items/'.$item->id)}}">{{$item->id}}</a> 
                                                </td>
                                               
                                                <td>{{$report->created_at}}</td>
                                                
                                                <td>
                                                    <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#modal-default{{$report->id}}">محتوى البلاغ</button>
                                                </td>
                                                
                                                <td>
                                                    {{ Form::open(array('method' => 'DELETE',"onclick"=>"return confirm('هل انت متأكد ؟!')",'files' => true,'url' => array('adminpanel/reports/'.$report->id))) }}
                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                    {!! Form::close() !!}
                                                </td>
                                                <td><input type="checkbox" class="sub_chk" data-id="{{$report->id}}"></td>
                                            </tr>

                                            <div class="modal fade" id="modal-default{{$report->id}}" style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span></button>
                                                        <h4 class="modal-title">محتوى البلاغ</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{$report->message}}
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
