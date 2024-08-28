@extends('admin.layouts.adminlayout')

@section('style')
    <style>
        #messages-list {
            list-style-type: none;
            padding: 0;
        }

        .message {
            padding: 5px 10px;
            margin: 5px;
            border-radius: 10px;
        }

        .own {
            background-color: #DCF8C6;
            align-self: flex-end;
        }

        .other {}

        #messages {
            display: flex;
            flex-direction: column;
            margin: 0 auto;
            width: 90%;
            max-width: 600px;
        }
    </style>
@endsection

@section('content-header')
@endsection

@section('main-content')
    <section style="background-color: #CDC4F9;">
        <div class="">

            <div class="row">
                <div class="col-md-12">

                    <div class="card" id="chat3" style="border-radius: 15px;">
                        <div class="card-body">
                            {{-- <div id="notification" class="alert alert-success invisible"></div> --}}
                            <div class="row">
                                <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">

                                    @include('admin.blocks.user-sidebar')

                                </div>

                                @isset($user)
                                    <div class="col-md-6 col-lg-7 col-xl-8">
                                        <div class=" fixed border">
                                            <div class="d-flex flex-row justify-content-start">
                                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                                                    alt="avatar 1" style="width: 45px; height: 100%;">
                                                <div>
                                                    <p class="small p-2 ms-3 mb-1 rounded-3" style="">{{ $user['name'] }}
                                                    </p>
                                                    <input id="user1" type="hidden" name="userId"
                                                        value="{{ $user->id }}">
                                                    @if ($user->status == 'online')
                                                        <p id=""
                                                            class="notification-{{ $user->id }} small ms-3 mb-3 rounded-3 float-end text-success">
                                                            online</p>
                                                    @else
                                                        <p id=""
                                                            class="notification-{{ $user->id }} small ms-3 mb-3 rounded-3 float-end text-muted">
                                                            offline</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <ul id="messages-list" class="pt-3 pe-3 overflow-auto "
                                            data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px">
                                            @foreach ($messages as $message)
                                                @if ($message->user_id == Auth::guard('admin')->user()->id)
                                                    <li class="d-flex flex-row justify-content-end">
                                                        <div>
                                                            <p
                                                                class="small p-2 me-3 mb-1 text-white rounded-pill bg-primary text-break ">
                                                                {{ $message->message_text }}</p>
                                                            </p>
                                                            <p class="small me-3 mb-3 rounded-pill text-muted">
                                                                {{ $message->sent_at }}</p>
                                                        </div>
                                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                                            alt="avatar 1" style="width: 45px; height: 100%;">
                                                    </li>
                                                @else
                                                    <li class="d-flex flex-row justify-content-start">
                                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                                                            alt="avatar 1" style="width: 45px; height: 100%;">
                                                        <div>
                                                            <p class="small p-2 ms-3 mb-1 rounded-pill text-break"
                                                                style="background-color: #f5f6f7;">{{ $message->message_text }}
                                                            </p>
                                                            <p class="small ms-3 mb-3 rounded-pill text-muted float-end">
                                                                {{ $message->sent_at }}</p>
                                                        </div>
                                                    </li>
                                                @endif
                                            @endforeach



                                        </ul>
                                        <form class="bg-white mb-3" action="{{ route('admin.send.message', $user->id) }}"
                                            method="post">
                                            @csrf
                                            <div data-mdb-input-init class="form-outline">
                                                <textarea name="message" class="form-control" id="sentMessage" rows="4"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-info btn-rounded mt-2">Send</button>
                                        </form>
                                    </div>
                                @endisset
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection

@section('scripts')
    <script type="module"></script>
@endsection
