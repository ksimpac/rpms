<html>

<head>
</head>

<body>
    <table border="1">
        <thead>
            <tr>
                <th rowspan="2">編號</th>
                <th colspan="15">基本資料</th>
                <th colspan="{{ 11 * $educations->educations_count }}">學歷</th>
                <th colspan="{{ 10 * $thesis->thesis_count }}">期刊論文</th>
                <th colspan="{{ 7 * $industry_experiences->industry_experiences_count }}">經歷</th>

                {{ Debugbar::info($tcases) }}
                @if($tcases->tcases_count != 0)
                <th colspan="{{ 7 * $tcases->tcases_count }}">產學合作計畫參與</th>
                @endif

                {{ Debugbar::info($most_projects->most_projects_count) }}
                @if($most_projects->most_projects_count != 0)
                <th colspan="{{ 6 * $most_projects->most_projects_count }}">科技部專題研究計畫</th>
                @endif

                {{ Debugbar::info($thesis_confs->thesis_confs_count) }}
                @if($thesis_confs->thesis_confs_count != 0)
                <th colspan="{{ 6 * $thesis_confs->thesis_confs_count }}">研討會論文</th>
                @endif

                {{ Debugbar::info($others->others_count) }}
                @if($others->others_count != 0)
                <th colspan="{{ 1 * $others->others_count }}">其他有助審查資料</th>
                @endif
            </tr>
            <tr>
                <th>中文姓名</th>
                <th>英文姓氏</th>
                <th>英文名字</th>
                <th>生日</th>
                <th>性別</th>
                <th>聯絡電話</th>
                <th>戶籍地址</th>
                <th>通訊地址</th>
                <th>教師證職級</th>
                <th>教師證影本</th>
                <th>公司機構名稱</th>
                <th>職稱</th>
                <th>到職年月</th>
                <th>專長領域</th>
                <th>曾授課程/可授課程</th>

                @for ($i = 1; $i <= $educations->educations_count; $i++)
                    <th>學校名</th>
                    <th>院系科名</th>
                    <th>修業年月起</th>
                    <th>修業年月迄</th>
                    <th>學位</th>
                    <th>修業狀況</th>
                    <th>畢業國家</th>
                    <th>畢業論文</th>
                    <th>指導教授</th>
                    <th>畢業證書</th>
                    <th>成績單</th>
                @endfor

                @for ($i = 1; $i <= $thesis->thesis_count; $i++)
                    <th>刊物名稱</th>
                    <th>年月</th>
                    <th>DOI</th>
                    <th>作者總人數</th>
                    <th>作者順序</th>
                    <th>Rank factor N/M</th>
                    <th>是否為通訊作者</th>
                    <th>論文名稱</th>
                    <th>收錄分類</th>
                    <th>佐證資料</th>
                @endfor

                @for ($i = 1; $i <= $industry_experiences->industry_experiences_count; $i++)
                    <th>任職單位</th>
                    <th>職稱</th>
                    <th>兼專任</th>
                    <th>工作內容</th>
                    <th>任職時間起</th>
                    <th>任職時間迄</th>
                    <th>佐證資料</th>
                @endfor

                @for ($i = 1; $i <= $tcases->tcases_count; $i++)
                    <th>計畫名稱</th>
                    <th>合作機構名稱</th>
                    <th>執行起始日期</th>
                    <th>執行結束日期</th>
                    <th>工作類別</th>
                    <th>計畫總金額</th>
                    <th>佐證資料</th>
                @endfor

                @for ($i = 1; $i <= $most_projects->most_projects_count; $i++)
                    <th>計畫名稱</th>
                    <th>執行起始日期</th>
                    <th>執行結束日期</th>
                    <th>工作類別</th>
                    <th>計畫總金額</th>
                    <th>佐證資料</th>
                @endfor

                @for ($i = 1; $i <= $thesis_confs->thesis_confs_count; $i++)
                    <th>研討會名稱</th>
                    <th>論文名稱</th>
                    <th>發表年份</th>
                    <th>作者總人數</th>
                    <th>是否為通訊作者</th>
                    <th>舉行之國家/城市</th>
                @endfor

                @for ($i = 1; $i <= $others->others_count; $i++)
                    <th>佐證資料</th>
                @endfor

            </tr>
        </thead>

        <tbody>
            @foreach ($users as $index => $user)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $user->chineseName }}</td>

            <td>{{ $user->general_info->englishLastName }}</td>
            <td>{{ $user->general_info->englishFirstName }}</td>
            <td>{{ $user->general_info->birthday }}</td>
            <td>{{ $user->general_info->sex == '0' ? '女' : '男' }}</td>
            <td>{{ $user->general_info->telephone }}</td>
            <td>{{ $user->general_info->Permanent_Address }}</td>
            <td>{{ $user->general_info->Residential_Address }}</td>
            <td>{{ $user->general_info->teacherCertificateType }}</td>
            <td>
                @if($user->general_info->teacherCertificateFiles != NULL)
                <a href="{{ url(Storage::url('general_info/' . $user->general_info->teacherCertificateFiles)) }}">
                    {{ $user->general_info->teacherCertificateFiles }}
                </a>
                @else
                無
                @endif
            </td>
            <td>{{ $user->general_info->working_units }}</td>
            <td>{{ $user->general_info->position }}</td>
            <td>{{ $user->general_info->startDate }}</td>
            <td>{{ $user->general_info->specialization }}</td>
            <td>{{ $user->general_info->course }}</td>

            @foreach($user->educations as $index => $row)
            <td>{{ $row->schoolName }}</td>
            <td>{{ $row->department }}</td>
            <td>{{ $row->startDate }}</td>
            <td>{{ $row->endDate }}</td>
            <td>{{ $row->degree }}</td>
            <td>{{ $row->status }}</td>
            <td>{{ $row->country }}</td>
            <td>{{ $row->thesis }}</td>
            <td>{{ $row->advisor }}</td>
            <td>
                <a href="{{ url(Storage::url('education/certificate/' . $row->certificate)) }}">
                    {{ $row->certificate }}
                </a>
            </td>
            <td>
                <a href="{{ url(Storage::url('education/transcript/' . $row->transcript)) }}">
                    {{ $row->transcript }}
                </a>
            </td>
            @endforeach

            @foreach($user->thesis as $index => $row)
            <td>{{ $row->publicationName }}</td>
            <td>{{ $row->publicationDate }}</td>
            <td>{{ $row->DOI }}</td>
            <td>{{ $row->authorNo }}</td>
            <td>{{ $row->order }}</td>
            <td>{{ $row->rank_factor }}</td>
            <td>{{ $row->corresponding_author == '0' ? '否' : '是' }}</td>
            <td>{{ $row->thesisName }}</td>
            <td>{{ $row->type }}</td>
            <td>
                <a href="{{ url(Storage::url('thesis/' . $row->identification)) }}">
                    {{ $row->identification }}
                </a>
            </td>
            @endforeach

            @for ($i = 1; $i <= ($thesis->thesis_count - $user->thesis_count); $i++)
                @for ($j = 1; $j <= 10; $j++)
                <td></td>
                @endfor
            @endfor

            @foreach($user->industry_experiences as $index => $row)
            <td>{{ $row->working_units }}</td>
            <td>{{ $row->position }}</td>
            <td>{{ $row->type }}</td>
            <td>{{ $row->job_description }}</td>
            <td>{{ $row->startDate }}</td>
            <td>{{ $row->endDate }}</td>
            <td>
                <a href="{{ url(Storage::url('industry_experience/' . $row->identification)) }}">
                    {{ $row->identification }}
                </a>
            </td>
            @endforeach

            @for ($i = 1; $i <= ($industry_experiences->industry_experiences_count - $user->industry_experiences_count); $i++)
                @for ($j = 1; $j <= 7; $j++)
                <td></td>
                @endfor
            @endfor

            @foreach($user->tcases as $index => $row)
            <td>{{ $row->projectName }}</td>
            <td>{{ $row->collaboration_name }}</td>
            <td>{{ $row->startDate }}</td>
            <td>{{ $row->endDate }}</td>
            <td>{{ $row->jobkind }}</td>
            <td>{{ $row->plantotal_money }}</td>
            <td>
                <a href="{{ url(Storage::url('tcase/' . $row->identification)) }}">
                    {{ $row->identification }}
                </a>
            </td>
            @endforeach

            @for ($i = 1; $i <= ($tcases->tcases_count - $user->tcases_count); $i++)
                @for ($j = 1; $j <= 7; $j++)
                <td></td>
                @endfor
            @endfor

            @foreach($user->most_projects as $index => $row)
            <td>{{ $row->projectName }}</td>
            <td>{{ $row->startDate }}</td>
            <td>{{ $row->endDate }}</td>
            <td>{{ $row->jobkind }}</td>
            <td>{{ $row->plantotal_money }}</td>
            <td>
                <a href="{{ url(Storage::url('MOST_project/' . $row->identification)) }}">
                    {{ $row->identification }}
                </a>
            </td>
            @endforeach

            @for ($i = 1; $i <= ($most_projects->most_projects_count - $user->most_projects_count); $i++)
                @for ($j = 1; $j <= 6; $j++)
                <td></td>
                @endfor
            @endfor

            @foreach($user->thesis_confs as $index => $row)
            <td>{{ $row->conf_name }}</td>
            <td>{{ $row->thesisName }}</td>
            <td>{{ $row->years }}</td>
            <td>{{ $row->authorNo }}</td>
            <td>{{ $row->corresponding_author == '0' ? '否' : '是' }}</td>
            <td>{{ $row->country }}</td>
            @endforeach

            @for ($i = 1; $i <= ($thesis_confs->thesis_confs_count - $user->thesis_confs_count); $i++)
                @for ($j = 1; $j <= 6; $j++)
                <td></td>
                @endfor
            @endfor

            @foreach($user->others as $index => $row)
            <td>
                <a href="{{ url(Storage::url('other/' . $row->identification)) }}">
                    {{ $row->identification }}
                </a>
            </td>
            @endforeach

            @for ($i = 1; $i <= ($others->others_count - $user->others_count); $i++)
                <td></td>
            @endfor
        </tr>
        @endforeach
        </tbody>
    </table>
</body>

</html>
