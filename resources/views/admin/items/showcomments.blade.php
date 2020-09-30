 @extends('admin/include/master')
@section('title') لوحة التحكم | مشاهدة تعليقات الاعلان @endsection
@section('content')

    <section class="content-header">
      <h1>
        كل التعليقات
      </h1>
    </section>

    <section style="direction: ltr;" class="content">
      <div class="row">
        <div class="col-md-12">
          <ul class="timeline">
        @if(count($comments) >0)

                @foreach($comments as $comm) 
                <?php $commowner = DB::table('members')->where('id',$comm->user_id)->first(); ?>
                        <li>
                            <i class="fa fa-comments bg-yellow"></i>
                            <div style="direction: rtl;margin-bottom: 1%;" class="timeline-item">
                                <span style="float:left;" class="time"><i class="fa fa-clock-o"></i>{{ $comm->created_at }}</span>
                                <h3 style="margin-left: 75%;" class="timeline-header"><a href="{{asset('adminpanel/users/'.$comm->user_id)}}">{{$commowner->name}}</a>  علق ع هذا الاعلان</h3>
                                <div style="float: right;" class="timeline-body">
                                     {{$comm->content}}
                                </div>
                                <br>
                                <div class="timeline-footer">
                                {{ Form::open(array('method' => 'DELETE',"onclick"=>"return confirm('هل انت متأكد ؟!')",'files' => true,'url' => array('adminpanel/items/'.$comm->id))) }}
                                <input type="hidden" name="delcomment">
                                <button style="width: 10%;" type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i> حذف </button>
                                {!! Form::close() !!}
                                </div>
                            </div>
                        </li>
                @endforeach
           
        @else 
            <div style="direction: rtl;margin-bottom: 1%;" class="timeline-item">
                <h3 style="margin-left: 75%;" class="timeline-header"></h3>
                <div style="float: right;" class="timeline-body">
                لا يوجد تعليقات ضمن هذا المنتج
                </div> 
            </div>
        @endif          
          </ul>
        </div>
      </div>
    </section>
@endsection 