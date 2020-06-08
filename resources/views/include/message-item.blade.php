
@if(($v->sender == 'company' && $company != null) ||($v->sender=='user' && $user!= null))
    <div class="myMessage">
        <div class="messageItem">
            <div class="header-msg">
                @if($v->sender == 'company')
                    <img
                        src="{{$v->company->img}}"
                        alt="">
                    <span>{{$v->company->name}}</span>
                @elseif($v->sender == 'user')
                    <img
                        src="{{$v->user->img}}"
                        alt="">
                    <span>{{$v->user->surname}}</span>
                @endif
            </div>
            <div class="body-msg">
                <p>{{$v->message}}</p>
            </div>
            <div class="footer-msg">
                <p>{{date('d-m-Y h:s',strtotime($v->created_at))}}</p>
            </div>
        </div>
    </div>
@else
    <div>
        <div class="messageItem">
            <div class="header-msg">
                @if($v->sender == 'company')
                    <img
                        src="{{$v->company->img}}"
                        alt="">
                    <span>{{$v->company->name}}</span>
                @elseif($v->sender == 'user')
                    <img
                        src="{{$v->user->img}}"
                        alt="">
                    <span>{{$v->user->surname}}</span>
                @endif
            </div>
            <div class="body-msg">
                <p>{{$v->message}}</p>
            </div>
            <div class="footer-msg">
                <p>{{date('d-m-Y h:s',strtotime($v->created_at))}}</p>
            </div>
        </div>
    </div>
@endif
