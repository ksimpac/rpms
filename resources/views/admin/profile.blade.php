@extends('layouts.main')

@section('title')
<h4>檢視</h4>
@endsection

@section('card-body-content')
<form action="{{ route('admin.profile.show') }}" method="post">
    @csrf
    <select name="nameList">
        @foreach ($collection as $item)
        <option value="{{ $item['id'] }}">{{ $item['chineseName'] }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary">檢視</button>
</form>

@if (isset($user))
<style>
    table.table-bordered {
        border: 1px solid black;
        margin-top: 20px;
    }

    table.table-bordered>tbody>tr>td {
        border: 1px solid black;
    }
</style>
<table class="table table-bordered border-dark">
    <tr>
        <td class="bg-primary text-white">中文/英文姓名</td>
        <td colspan="3">
            {{ $user->chineseName }}/{{ $user->general_info->englishFirstName.' '.$user->general_info->englishLastName }}
        </td>
        <td class="bg-primary text-white">性別</td>
        <td>
            {{ $user->general_info->sex == 0 ? '女' : '男' }}
        </td>
    </tr>
    <tr>
        <td class="bg-primary text-white">生日</td>
        <td>
            {{ $user->general_info->birthday }}
        </td>
        <td class="bg-primary text-white">聯絡電話</td>
        <td>
            {{ $user->general_info->telephone }}
        </td>
        <td class="bg-primary text-white">e-mail</td>
        <td>
            {{ $user->email }}
        </td>
    </tr>
    <tr>
        <td class="bg-primary text-white">通訊地址</td>
        <td colspan="3">
            {{ $user->general_info->Residential_Address }}
        </td>
        <td class="bg-primary text-white">教師證級別</td>
        <td>
            {{ $user->general_info->teacherCertificateType }}<br />
            @if($user->general_info->teacherCertificateType != '無')
            <a href="{{ url(Storage::url('general_info/' . $user->general_info->teacherCertificateFiles)) }}"
                target="_blank">
                教師證憑證
            </a>
            @endif
        </td>
    </tr>
    <tr>
        <td class="bg-primary text-white">目前現職</td>
        <td>{{ $user->general_info->position }}</td>
        <td class="bg-primary text-white">職位</td>
        <td>{{ $user->general_info->working_units }}</td>
        <td class="bg-primary text-white">到職年月</td>
        <td>{{ $user->general_info->startDate }}</td>
    </tr>
    <tr>
        <td class="bg-primary text-white">專長領域</td>
        <td colspan="2">{{ $user->general_info->specialization }}</td>
        <td class="bg-primary text-white" style="width:14%">可授課程</td>
        <td style="width:16%" colspan="2">{{ $user->general_info->course }}</td>
    </tr>

    @foreach ($user->educations as $education)
    <tr>
        <td class="align-middle bg-primary text-white">{{ $education->degree }}學位</td>
        <td class="text-left" colspan="2">
            {{ $education->schoolName }}<br />
            {{ $education->department }}
        </td>
        <td class="align-middle bg-primary text-white">修業年月起訖</td>
        <td colspan="2">
            {{ $education->startDate }}<br />
            <a href="{{ url(Storage::url('education/certificate/' . $education->certificate)) }}" target="_blank">
                畢業證書
            </a><br />
            <a href="{{ url(Storage::url('education/transcript/' . $education->transcript)) }}" target="_blank">
                成績單
            </a>
        </td>
    </tr>
    @if ($education->degree != '大學')
    <tr>
        <td class="bg-primary text-white">{{ $education->degree }}論文名稱</td>
        <td colspan="2">{{ $education->thesis }}</td>
        <td class="bg-primary text-white">指導老師</td>
        <td colspan="2">{{ $education->advisor }}</td>
    </tr>
    @endif
    @endforeach

    <tr>
        <td class="align-middle bg-primary text-white" rowspan="2">
            近5年期刊/<br />
            研討會論文
        </td>
        <td class="bg-primary text-white">期刊論文</td>
        <td>SCI:<span>{{ $user->SCI_count }}</span>篇</td>
        <td>SCIE:<span>{{ $user->SCIE_count }}</span>篇</td>
        <td>SSCI:<span>{{ $user->SSCI_count }}</span>篇</td>
        <td>TSSCI或其他:<span>{{ $user->others_count }}</span>篇</td>
    </tr>
    <tr>
        <td class="bg-primary text-white">研討會論文</td>
        <td colspan="4"><span>{{ $user->thesis_confs_count }}</span>篇</td>
    </tr>
    <tr>
        <td colspan="6">
            @foreach($user->thesis as $thesis)
            {{ ++$loop->index }}、&nbsp;
            <a href="{{ url(Storage::url('thesis/' . $thesis->identification)) }}" target="_blank">
                {{ $thesis->thesisName }}
            </a>&nbsp;({{ $thesis->rank_factor }})<br />
            @endforeach
        </td>
    </tr>
    <tr>
        <td class="bg-primary text-white">
            實務工作經驗<br />
            任職單位/職稱/專兼任/(起訖年月)
        </td>
        <td colspan="5">
            @foreach ($user->industry_experiences as $industry_experience)
            <u>
                {{ $industry_experience->working_units }}/{{ $industry_experience->position }}/{{ $industry_experience->type }}/{{ '('.$industry_experience->startDate.'~'.$industry_experience->endDate.')' }}
            </u>
            <a href="{{ url(Storage::url('industry_experience/' . $industry_experience->identification)) }}"
                target="_blank">
                PDF
            </a><br />
            @endforeach
        </td>
    </tr>
    <tr>
        <td class="bg-primary text-white" colspan="6">近5年產學合作計畫</td>
    </tr>
    <tr>
        <td colspan="6">
            @forelse ($user->tcases as $tcase)
            {{ ++$loop->index }}、&nbsp;
            {{ $tcase->projectName }}、
            {{ $tcase->collaboration_name }}、
            {{ $tcase->startDate.'~'.$tcase->endDate }}、
            {{ $tcase->jobkind }}、
            {{ $tcase->plantotal_money }}、
            <a href="{{ url(Storage::url('tcase/' . $tcase->identification)) }}" target="_blank">
                PDF
            </a>
            <br />
            @empty
            無
            @endforelse
        </td>
    </tr>
    <tr>
        <td class="bg-primary text-white" colspan="6">近5年科技部專題研究計畫</td>
    </tr>
    <tr>
        <td colspan="6">
            @forelse ($user->most_projects as $most_project)
            {{ ++$loop->index }}、&nbsp;
            {{ $most_project->projectName }}、
            {{ $most_project->startDate.'~'.$most_project->endDate }}、
            {{ $most_project->jobkind }}、
            {{ $most_project->plantotal_money }}、
            <a href="{{ url(Storage::url('MOST_project/' . $most_project->identification)) }}" target="_blank">
                PDF
            </a>
            <br />
            @empty
            無
            @endforelse
        </td>
    </tr>
    <tr>
        <td class="bg-primary text-white" colspan="6">近5年研討會論文</td>
    </tr>
    <tr>
        <td colspan="6">
            @forelse ($user->thesis_confs as $thesis_conf)
            {{ ++$loop->index }}、&nbsp;
            {{ $thesis_conf->conf_name }}、
            {{ $thesis_conf->thesisName }}、
            {{ $thesis_conf->years }}、
            {{ $thesis_conf->authorNo }}、
            {{ $thesis_conf->country }}
            <br />
            @empty
            無
            @endforelse
        </td>
    </tr>
    <tr>
        <td class="bg-primary text-white" style="width:16%">其他有助審查事蹟<br />
            (如獲獎、專業證照、英文能力)
        </td>

        <td colspan="5">
            @forelse ($user->others as $other)
            {{ ++$loop->index }}、&nbsp;
            <a href="{{ url(Storage::url('other/' . $other->identification)) }}" target="_blank">
                {{ $other->identification }}
            </a>
            <br />
            @empty
            無
            @endforelse
        </td>
    </tr>
</table>
@endif
@endsection
