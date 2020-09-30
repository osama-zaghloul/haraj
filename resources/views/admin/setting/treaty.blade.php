@extends('admin.include.master')
@section('title') لوحة التحكم | معاهدة الإستخدام ]  @endsection
@section('content')

<section class="content">
        <div class="row">
                <div class="col-xs-12">
              {{ Form::open(array('method' => 'patch','url' => 'adminpanel/treaty/'.$treaty->id )) }}
                <div class="box-body">

                    <!-- editor -->
                    <div class="col-md-12">
                            <div class="box box-info">
                                <div class="box-header">  
                                <h3 class="box-title" >
                                   معاهدة الإستخدام    
                                </h3>
                                </div>
                                <div class="box-body pad">
                                    <textarea id="editor1" name="treaty" rows="10" cols="80" required>{{$treaty->treaty}}</textarea>
                                    @if ($errors->has('treaty'))
                                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('treaty') }}</div>
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