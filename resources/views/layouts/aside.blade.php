<aside class="p-0 bg-dark flex-shrink-1">
    <nav class="navbar navbar-expand navbar-light bg-light flex-md-column flex-row align-items-start">
        <div class="collapse navbar-collapse">
            <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between">
                @if(Auth::user()->is_admin == 0)
                <li class="nav-item">
                    <a class="nav-link pl-0" href="{{ route('general_info.index') }}"><span
                            class="d-none d-md-inline">基本資料</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="{{ route('education.index') }}"><span
                            class="d-none d-md-inline">學歷</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="{{ route('thesis.index') }}"><span
                            class="d-none d-md-inline">期刊論文</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="{{ route('industry_experience.index') }}"> <span
                            class="d-none d-md-inline">經歷</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="{{ route('tcase.index') }}"><span
                            class="d-none d-md-inline">產學合作計畫參與</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="{{ route('most_project.index') }}"><span
                            class="d-none d-md-inline">科技部專題研究計畫</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="{{ route('thesis_conf.index') }}"><span
                            class="d-none d-md-inline">研討會論文</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="{{ route('other.index') }}"><span
                            class="d-none d-md-inline">其他有助審查資料</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="{{ route('signup.store') }}" onclick="event.preventDefault();
                            document.getElementById('signupForm').submit();"><span
                            class="d-none d-md-inline text-success">
                            <h4>報名</h4>
                        </span>
                        <span class="text-danger">(點下報名後無法修改)</span>
                    </a>

                    <form id="signupForm" action="{{ route('signup.store') }}" method="post" class="d-none">
                        @csrf
                    </form>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link pl-0" href="{{ route('admin.export') }}" onclick="event.preventDefault();
                    document.getElementById('export-form').submit();"><span class="d-none d-md-inline">匯出資料</span></a>

                    <form id="export-form" action="{{ route('admin.export') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>

                <li class="nav-item">
                    <a class="nav-link pl-0" href="{{ route('admin.profile.index') }}"><span
                            class="d-none d-md-inline">檢視</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link pl-0" href="{{ route('admin.register.create') }}"><span
                            class="d-none d-md-inline">註冊管理員帳號</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link pl-0" href="{{ route('admin.deadline.index') }}"><span
                            class="d-none d-md-inline">設定截止日期</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link pl-0" href="{{ route('admin.removeUsers.index') }}"><span
                            class="d-none d-md-inline">刪除報名資料</span></a>
                </li>
                @endif
            </ul>
        </div>
    </nav>
</aside>
