@extends('admin.include.master')
@section('title') لوحة التحكم |  نظام الخصم  @endsection
@section('content')
  
<section class="content">
        <div class="row">
                <div class="col-xs-12">
              {{ Form::open(array('method' => 'patch','url' => 'adminpanel/dissystem/'.$dissystem->id )) }}
                <div class="box-body">
                    <!-- editor -->
                    <div class="col-md-12">
                            <div class="box box-info">
                                <div class="box-header">
                                <h3 class="box-title" >
                                 نظام الخصم النص الأول
                                </h3>
                                </div>
                                <div class="box-body pad">
                                    <textarea id="editor1" name="dissystem" rows="10" cols="80" required>{{$dissystem->discount_system}}</textarea>
                                    @if ($errors->has('dissystem'))
                                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('dissystem') }}</div>
                                    @endif
                                </div>
                            </div>
                    </div>
                    
                    <div class="col-md-12">
                            <div class="box box-info">
                                <div class="box-header">
                                <h3 class="box-title" >
                                نظام الخصم النص الثاني
                                </h3>
                                </div>
                                <div class="box-body pad">
                                    <textarea id="editor2" name="dissystem1" rows="10" cols="80" required>{{$dissystem->discount_system1}}</textarea>
                                    @if ($errors->has('dissystem1'))
                                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('dissystem1') }}</div>
                                    @endif
                                </div>
                            </div>
                    </div>

                    <!-- editor -->
                
                    
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary col-md-offset-4 col-md-4">تعديل</button>
                    </div>
    {!! Form::close() !!}
    </div>
</div> 
</div>
</section>

@endsection 