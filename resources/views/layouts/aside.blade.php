<aside class="p-0 bg-dark flex-shrink-1">
    <nav class="navbar navbar-expand navbar-light bg-light flex-md-column flex-row align-items-start">
        <div class="collapse navbar-collapse">
            <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between">
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
                    <a class="nav-link pl-0" href="{{ route('MOST_project.index') }}"><span
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
                            class="d-none d-md-inline">報名</span></a>

                    <form id="signupForm" action="{{ route('signup.store') }}" method="post" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </nav>
</aside>
