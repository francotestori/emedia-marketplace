<?php
use App\Event;
use App\EventThreads;
?>
<div class="panel panel-default">
    <div class="panel-title">
        <div class="row home-welcome">
            <div class="avatar-container">
                <img src="{{ asset('img/avatar.png')}}" class="img-responsive img-circle">
            </div>
            <div class="home-welcome-text">
                <h2>{{Lang::get('titles.home.common.welcome', ['name' => ""])}}<strong>{{$user->name}}</strong></h2>
                @if(Auth::user()->isAdvertiser())
                    <h4 class="subheading">{{Lang::get('messages.advertiser.tuft')}}</h4>
                @else
                    <h4 class="subheading">{{Lang::get('messages.editor.tuft')}}</h4>
                @endif
            </div>
        </div>
        <div class="row home-info-btns">
            <div class="col-md-12">
                @if($user->isEditor())
                    <a href="{{asset('pdf/eMediaMarket_GuíadeEditores_V02 .pdf')}}" target="_blank" class="btn btn-default btn-invert-emedia">
                        <i class="fa fa-book"></i>
                        {{Lang::get('titles.home.common.guide.editor')}}
                    </a>
                @else
                    <a href="{{asset('pdf/eMediaMarket_GuíadeAnunciantes_V02.pdf')}}" target="_blank" class="btn btn-default btn-invert-emedia">
                        <i class="fa fa-book"></i>
                        {{Lang::get('titles.home.common.guide.advertiser')}}
                    </a>
                @endif

            </div>
        </div>
    </div>
    <br>

    <div class="box-row clearfix">
        <div class="home-box msj-box">
            <div class="box-title">
                <h3>
                    <i class="fa fa-envelope"></i>
                    <a href="{{route('messages')}}">{{Lang::get('titles.messages')}}</a>
                </h3>
            </div>
            <div class="box-content">
            @foreach($threads as $thread)
                <div class="row">
                    <div class="col-md-9">
                        <h6><strong>{{$thread->participantsString(Auth::id())}}</strong></h6>
                        <p>
                            <span>{{Carbon\Carbon::parse($thread->updated_at->diffForHumans())}}</span>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <?php
                        $event_thread = EventThreads::where('thread_id', $thread->id)->first();
                        $event = Event::find($event_thread->event_id);
                        switch($event->state)
                        {
                            case 'ACCEPTED':
                                $class = "fa fa-check-circle";
                                $label = 'label-accepted';
                                break;
                            case 'PENDING':
                                $class = "fa fa-clock-o";
                                $label = "label-pending";
                                break;
                            default:
                                $class = "fa fa-times-circle";
                                $label = "label-closed";
                                break;
                        }
                        ?>
                        <span class="label {{$label}}"><i class="{{$class}} home-icon"></i></span>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
        <div class="home-box trans-box">
            <div class="box-title">
                <h3>
                    <i class="fa fa-line-chart"></i>
                    @if(Auth::user()->isEditor())
                        <a href="{{route('sales')}}">{{Lang::get('titles.wallet.transactions.main')}}</a>
                    @else
                        <a href="{{route('payments')}}">{{Lang::get('titles.wallet.transactions.main')}}</a>
                    @endif
                </h3>
            </div>
            <div class="box-content">
            @foreach($transactions as $transaction)
                <div class="row">
                    <div class="col-md-7">
                        <h6>
                            <strong>{{$transaction['user']}}</strong>
                        </h6>
                        @if(Agent::isMobile())
                            <p><span>{{str_limit(str_replace_first('http://','',$transaction['url']), 18)}}</span></p>
                        @else
                            <p><span>{{str_limit(str_replace_first('http://','',$transaction['url']), 21)}}</span></p>
                        @endif
                    </div>
                    <div class="col-md-5">
                        <?php
                        switch($transaction['state'])
                        {
                            case 'ACCEPTED':
                                $class = "fa fa-check-circle";
                                $label = 'label-accepted';
                                break;
                            case 'PENDING':
                                $class = "fa fa-clock-o";
                                $label = "label-pending";
                                break;
                            default:
                                $class = "fa fa-times-circle";
                                $label = "label-closed";
                                break;
                        }
                        ?>
                        <div class="row">
                            <div class="col-md-7">
                                <span class="money-total">{{Lang::get('attributes.currency').' '.$transaction['amount']}}</span>
                                </div>
                            <div class="col-md-5">
                                <span class="label {{$label}}"><i class="{{$class}} home-icon"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
        <div class="home-box wallet-box">
            <div class="box-title">
                <h3>
                    <i class="fa fa-money"></i>
                    <a href="{{route('wallet')}}" class="wallet-box-title">{{Lang::get('titles.wallet.index')}}</a>
                </h3>
            </div>
            <div class="box-content">
                <h4>
                    <span class="money-total">{{Lang::get('attributes.currency').' '.$user->getWallet()->balance}}</span>
                </h4>
                @if($user->isEditor())
                    <a href="{{route('wallet')}}" class="btn btn-block btn-emedia">{{Lang::get('forms.basic.withdraw')}}</a>
                @else
                    <a href="{{route('wallet')}}" class="btn btn-block btn-emedia">{{Lang::get('forms.basic.deposit')}}</a>
                @endif
            </div>
        </div>
    </div>
    <br>
    <div class="clearfix">
        <div class="home-box-lg help-box">
            <div class="row">
                <div class="col-md-12">
                    <h3>{{Lang::get('titles.home.common.help')}}</h3>
                    <p class="subheading">{{Lang::get('titles.tufts.home.help')}}</p>
                    <a href="mailto:info@emediamarket.com">info@emediamarket.com</a>
                </div>
            </div>
        </div>
        <div class="home-box faq-box">
            <div class="col-md-12">
                <h3>{{Lang::get('titles.home.common.faq')}}</h3>
                <p class="subheading">{{Lang::get('titles.tufts.home.faq')}}</p>
                <a href="{{url('/faq')}}">{{Lang::get('titles.tufts.home.faq2')}}</a>
            </div>
        </div>
    </div>
</div>
