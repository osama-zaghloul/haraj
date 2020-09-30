@extends('admin/include/master')
@section('title') لوحة التحكم | تعديل العمولة @endsection
@section('content')

    <section class="content">
            <div class="row">
                <div class="col-xs-12">  
                    <div class="box box-primary">
    
                    <div class="box-header with-border">
                        <h3 class="box-title">تعديل العمولة </h3>
                    </div>
                
                {!! Form::open(array('method' => 'patch','files'=> true ,'url' =>'adminpanel/commissions/'.$commission->id)) !!}
                    <div class="box-body">

                       <div class="form-group col-md-6">
                                    <label>اختر القسم</label>
                                    <div class="form-group col-md-12">
                                        <select name="category_id" >
                                            <option value="">اختر القسم</option>
                                            @foreach ($cats as $cat)
                    
                                        <option @if($cat->id == $commission->category_id) selected @endif value="{{$cat->id}}">{{$cat->name}}</option>

                                            @endforeach
                                        </select>
                                    </div>  
                      </div>

                        <div class="form-group col-md-6">
                            <label> العمولة  </label>
                        <input type="number"  value="{{$commission->commission}}" class="form-control" name="commission" placeholder=" العمولة بالنسبة المئوية " value="{{ old('commission') }}" required>
                            @if ($errors->has('commission'))
                                <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('commission') }}</div>
                            @endif  
                        </div>
                        

                    </div>

                    <div class="box-footer">
                    <button style="width: 20%;margin-right: 40%;" type="submit" class="btn btn-success">تعديل</button>
                    </div>
                    {!! Form::close() !!}
            </div>
            </div>
    </section>
                            
@endsection 
