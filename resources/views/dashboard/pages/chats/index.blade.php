@extends('dashboard.layout.base')
@section('content')
@inject('options','App\Traits\Custom')
    <div class="chat-content-area mt-20">
        <div class="container-fluid">
            <div class="sidebar-left">
                <div class="sidebar">
                    <div class="chat-sidebar-header d-flex align-items-center">
                        <div class="avatar me-2">
                            <img src="{{empty($user->photo)?'https://ui-avatars.com/api/?name='.$user->name.'&background=random&round=true':$user->photo}}"
                                 width="50" height="50" class="rounded-circle" alt="image">
                        </div>

                        <form class="form-group position-relative mb-0">
                            <label><i class='bx bx-search'></i></label>
                            <input type="text" class="form-control" placeholder="Search here...">
                        </form>
                    </div>

                    <div class="sidebar-content d-flex chat-sidebar" data-simplebar>
                        <div class="tab">
                            <ul class="tabs">
                                <li>
                                    Chats
                                </li>
                            </ul>

                            <div class="tab_content">
                                <div class="tabs_item">
                                    <div class="products-details-tab-content">
                                        <div class="chat-menu">
                                            <label class="d-block list-group-label mt-0">Chats</label>

                                            <ul class="list-group list-group-user list-unstyled mb-0">
                                                @foreach($chats as $chat)
                                                    <li class="chatBox" data-chat-id="{{$chat->reference}}">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar me-2">
                                                                <img src="{{asset('dashboard/images/avatar-2.png')}}" width="50" height="50"
                                                                     class="rounded-circle" alt="image">

                                                                <span class="status-online"></span>
                                                            </div>

                                                            <div class="user-name">
                                                                @if($chat->sender!=$user->id)
                                                                    <h6 class="font-weight-bold">
                                                                        {{$options->getUserById($chat->sender)->name}}
                                                                    </h6>
                                                                @elseif($chat->receiver!=$user->id)
                                                                    <h6 class="font-weight-bold">
                                                                        {{$options->getUserById($chat->receiver)->name}}
                                                                    </h6>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-right">
                <div class="chat-area">
                    <div class="chat-list-wrapper">
                        <div class="chat-list">
                            <div class="chat-list-header d-flex align-items-center">
                                <div class="header-left d-flex align-items-center me-2">
                                    <div class="avatar me-2">
                                        <img src="{{asset('dashboard/images/avatar.png')}}" width="70" height="70" class="rounded-circle" alt="image">
                                        <span class="status-online"></span>
                                    </div>
                                    <h6 class="mb-0 font-weight-bold">Ellen Cranford</h6>
                                </div>

                                <div class="header-right text-end w-100">
                                    <ul class="list-unstyled mb-0">
                                        <li>
                                            <div class="dropdown">
                                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="ri-settings-4-line"></i>
                                                </button>

                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        <i class='bx bx-pin'></i> Pin to Top
                                                    </a>
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        <i class='bx bx-trash'></i> Delete Chat
                                                    </a>
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        <i class='bx bx-block'></i> Block
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="chat-container" data-simplebar>
                                <div class="chat-content">
                                    <div class="chat">
                                        <div class="chat-avatar">
                                            <a href="#" class="d-inline-block">
                                                <img src="{{asset('dashboard/images/avatar-2.png')}}" width="50" height="50" class="rounded-circle" alt="image">
                                            </a>
                                        </div>

                                        <div class="chat-body">
                                            <div class="chat-message">
                                                <p>👋Hi​! I'm a Dashli. Let me know if you have any questions regarding our tool or set up a demo to learn more!</p>
                                                <span class="time d-block">7:45 AM</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="chat chat-left">
                                        <div class="chat-avatar">
                                            <a href="#" class="d-inline-block">
                                                <img src="{{asset('dashboard/images/avatar.png')}}" width="50" height="50" class="rounded-circle" alt="image">
                                            </a>
                                        </div>

                                        <div class="chat-body">
                                            <div class="chat-message">
                                                <p>Could you describe EnvyTheme in one sentence?</p>
                                                <span class="time d-block">7:45 AM</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="chat">
                                        <div class="chat-avatar">
                                            <a href="#" class="d-inline-block">
                                                <img src="{{asset('dashboard/images/avatar-2.png')}}" width="50" height="50" class="rounded-circle" alt="image">
                                            </a>
                                        </div>

                                        <div class="chat-body">
                                            <div class="chat-message">
                                                <p><a href="https://envytheme.com/" target="_blank">EnvyTheme.com</a></p>
                                                <span class="time d-block">7:45 AM</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="badge badge-pill bg-light text-dark my-3">Yesterday</div>

                                    <div class="chat chat-left">
                                        <div class="chat-avatar">
                                            <a href="#" class="d-inline-block">
                                                <img src="{{asset('dashboard/images/avatar.png')}}" width="50" height="50" class="rounded-circle" alt="image">
                                            </a>
                                        </div>

                                        <div class="chat-body">
                                            <div class="chat-message">
                                                <p>What makes you different from other learning platforms?</p>
                                                <span class="time d-block">7:45 AM</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="chat">
                                        <div class="chat-avatar">
                                            <a href="#" class="d-inline-block">
                                                <img src="{{asset('dashboard/images/avatar-2.png')}}" width="50" height="50" class="rounded-circle" alt="image">
                                            </a>
                                        </div>

                                        <div class="chat-body">
                                            <div class="chat-message">
                                                <p>The best Innovative Chatbot and automations are here to expand.</p>
                                                <span class="time d-block">7:45 AM</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="chat chat-left">
                                        <div class="chat-avatar">
                                            <a href="#" class="d-inline-block">
                                                <img src="{{asset('dashboard/images/avatar.png')}}" width="50" height="50" class="rounded-circle" alt="image">
                                            </a>
                                        </div>

                                        <div class="chat-body">
                                            <div class="chat-message">
                                                <p>Great, Thank You!❤️</p>
                                                <span class="time d-block">7:45 AM</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="chat">
                                        <div class="chat-avatar">
                                            <a href="#" class="d-inline-block">
                                                <img src="{{asset('dashboard/images/avatar-2.png')}}" width="50" height="50" class="rounded-circle" alt="image">
                                            </a>
                                        </div>

                                        <div class="chat-body">
                                            <div class="chat-message">
                                                <p>👋Hi​! I'm a Dashli.</p>
                                                <span class="time d-block">7:45 AM</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="chat chat-left">
                                        <div class="chat-avatar">
                                            <a href="#" class="d-inline-block">
                                                <img src="{{asset('dashboard/images/avatar.png')}}" width="50" height="50" class="rounded-circle" alt="image">
                                            </a>
                                        </div>

                                        <div class="chat-body">
                                            <div class="chat-message">
                                                <p>What makes you different from other learning platforms?</p>
                                                <span class="time d-block">7:45 AM</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="chat-list-footer">
                                <form class="d-flex align-items-center">
                                    <div class="btn-box d-flex align-items-center me-2">
                                        <button class="emoji-btn d-inline-block me-2" data-bs-toggle="tooltip" data-placement="top" title="Emoji" type="button"><i class='bx bx-smile'></i></button>

                                        <button class="file-attachment-btn d-inline-block" data-bs-toggle="tooltip" data-placement="top" title="File Attachment" type="button"><i class='bx bx-paperclip'></i></button>
                                    </div>

                                    <input type="text" class="form-control" placeholder="Type your message...">

                                    <button type="submit" class="send-btn d-inline-block">Send <i class="bx bx-paper-plane"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
