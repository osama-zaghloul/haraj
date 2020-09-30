@extends('admin.include.master')
@section('title') لوحة التحكم |  قائمة السلع والإعلانات الممنوعة @endsection
@section('content')

<section class="content">
        <div class="row">
                <div class="col-xs-12">
              {{ Form::open(array('method' => 'patch','url' => 'adminpanel/bannedads/'.$bannedads->id )) }}
                <div class="box-body">

                    <!-- editor -->
                    <div class="col-md-12">
                            <div class="box box-info">
                                <div class="box-header">
                                <h3 class="box-title" >
                                 قائمة السلع والإعلانات الممنوعة النص الأول
                                </h3>
                                </div>
                                <div class="box-body pad">
                                    <textarea id="editor1" name="bannedads" rows="10" cols="80" required>{!! $bannedads->banned_ads !!}</textarea>
                                    @if ($errors->has('bannedads'))
                                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('bannedads') }}</div>
                                    @endif
                                </div>
                            </div>
                    </div>

                      <!-- editor -->
                      
                       <!-- editor -->
                    <div class="col-md-12">
                            <div class="box box-info">
                                <div class="box-header">
                                <h3 class="box-title" >
                                  قائمة السلع والإعلانات الممنوعة النص الثاني
                                </h3>
                                </div>
                                <div class="box-body pad">
                                    <textarea id="editor2" name="bannedads1" rows="10" cols="80" required>{!! $bannedads->banned_ads1 !!}</textarea>
                                    @if ($errors->has('bannedads1'))
                                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('bannedads1') }}</div>
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