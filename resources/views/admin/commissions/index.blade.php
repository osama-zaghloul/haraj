@extends('admin.include.master')
@section('title') لوحة التحكم | اضافة عمولة @endsection
@section('content')

    <section class="content">
            <div class="row">
                <div class="col-xs-12">  
                    <div class="box box-primary">
    
                    <div class="box-header with-border">
                        <h3 class="box-title">إضافة عمولة </h3>
                    </div>
                
                {!! Form::open(array('method' => 'POST','files'=> true ,'url' =>'adminpanel/commissions')) !!}
                    <div class="box-body">

                         <div class="form-group col-md-6">
                                    <label>اختر القسم</label>
                                    <div class="form-group col-md-12">
                                        <select name="category_id" >
                                            <option value="">اختر القسم</option>
                                            @foreach ($cats as $cat)
                    
                                        <option value="{{$cat->id}}">{{$cat->name}}</option>

                                            @endforeach
                                        </select>
                                    </div>  
                      </div>

                        <div class="form-group col-md-6">
                            <label> العمولة  </label>
                            <input type="number" class="form-control" name="commission" placeholder=" العمولة بالنسبة المئوية " value="{{ old('commission') }}" required>
                            @if ($errors->has('commission'))
                                <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('commission') }}</div>
                            @endif  
                        </div>
                        
                        
                        
                    </div>

                    <div class="box-footer">
                    <button style="width: 20%;margin-right: 40%;" type="submit" class="btn btn-primary">إضافة</button>
                    </div>
                    {!! Form::close() !!}
            </div>
            </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
            <div class="box box-primary">  

                <div class="box-header with-border">
                    <h3 class="box-title">كل  العمولات</h3>
                </div>    

                <div class="table-responsive box-body">
                <button style="margin-bottom: 10px;float:left;" class="btn btn-danger delete_all" data-url="{{ url('mycommissionDeleteAll') }}"><i class="fa fa-trash-o" aria-hidden="true"></i> حذف المحدد</button>
                    <table id="example3" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">القسم</th>
                                    <th style="text-align:center;">العمولة </th>
                                    <th style="text-align:center;"> تعديل</th>
                                    <th style="text-align:center;"> حذف</th> 
                                    <th width="50px"><input type="checkbox" id="master"></th>
                                </tr>
                            </thead>
                    
                            <tbody> 
                                @foreach($allcommissions as $commission)
                                <?php
                                $category = DB::table('maincategories')->where('id',$commission->category_id)->first();
                                ?>
                                    <tr>
                                        
                                        <td>{{$category->name}}</td>
                                        <td>{{$commission->commission}} %</td>
                            

                                        <td>
                                            <a href='{{asset("adminpanel/commissions/".$commission->id."/edit")}}' class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        </td>

                                        <td>
                                            {{ Form::open(array('method' => 'DELETE',"onclick"=>"return confirm('هل انت متأكد ؟!')",'files' => true,'url' => array('adminpanel/commissions/'.$commission->id))) }}
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            {!! Form::close() !!}
                                        </td>
                                        <td><input type="checkbox" class="sub_chk" data-id="{{$commission->id}}"></td>
                                    </tr>
                            @endforeach
                            </tbody> 
                    </table>
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