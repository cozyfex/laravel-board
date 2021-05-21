@extends('design::layouts.web')

@section('title', $title)

@section('content')
    <section class="container">
        <div class="page-title">{{ $title }}</div>

        <!--
        <form name="" action="" method="post">
            <input type="hidden" id="field" name="field" value="{{ $field }}">
            <input type="hidden" id="sort" name="sort" value="{{ $sort }}">

            <div class="data-search-wrap">
                <div class="data-sel">
                    <select data-style="selectColor-black">
                        <option data-subtext="(Sub)">옵션A</option>
                        <option>옵션B</option>
                        <option>옵션C</option>
                    </select>
                    <select data-style="selectColor-gray">
                        <option data-subtext="(Sub)">옵션A</option>
                        <option>옵션B</option>
                        <option>옵션C</option>
                    </select>
                    <select data-live-search="true">
                        <option>옵션 검색</option>
                        <option>옵션A</option>
                        <option>옵션B</option>
                        <option>옵션C</option>
                        <option>옵션D</option>
                        <option>옵션E</option>
                        <option>옵션F</option>
                        <option>옵션G</option>
                        <option>옵션H</option>
                        <option>옵션I</option>
                    </select>
                    <select id="search-cate">
                        <option>검색항목</option>
                        <option>아이디</option>
                        <option>이름</option>
                        <option>연락처</option>
                    </select>
                    <input type="text" name="" value="" class="span250" placeholder="검색어">
                    <a href="#" class="btn gray">검색</a>
                </div>
            </div>
        </form>
        -->

        <div class="tbl-basic cell td-h4 mt10">
            <div class="tbl-header">
                <div class="caption">총 <b>{{ $boards->total() }}</b>개 글이 있습니다</div>
                <!--
                <div class="rightSet">
                    <a href="#" class="btn green small icon-excel">엑셀 다운로드</a>
                </div>
                -->
            </div>
            <table>
                <colgroup>
                    <col width="50">
                    <col>
                    <col width="140">
                    <col width="140">
                    <col width="160">
                </colgroup>
                <thead>
                    <tr>
                        <th>
                            <a href="#" class="">번호</a>
                        </th>
                        <th>
                            <a href="#" class="sort" data-field="title">제목</a>
                        </th>
                        <th>
                            <a href="#" class="sort" data-field="name">이름</a>
                        </th>
                        <th>
                            <a href="#" class="sort" data-field="id">ID</a>
                        </th>
                        <th>
                            <a href="#" class="sort" data-field="date">등록일</a>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @if($boards->total() > 0)
                        @php
                            $pageCount = $boards->currentPage() * $boards->perPage();
                            $total = ($boards->total() >= $boards->currentPage() * $boards->perPage()) ? $boards->total() : $boards->currentPage() * $boards->perPage();
                            $pageTotal = $total - $pageCount;
                        @endphp
                        @foreach($boards as $board)
                            <tr>
                                <td>{{ $pageTotal + $loop->remaining + 1 }}</td>
                                <td>
                                    <a href="{{ route('board.show', $board) }}">{{ $board->title }}</a>
                                </td>
                                <td>{{ $board->author }}</td>
                                <td>{{ $board->username }}</td>
                                <td>{{ $board->created_at }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="td_empty">
                                <div class="empty_list" data-text="등록된 게시물이 없습니다."></div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

            {{ $boards->links('board::board.pagination') }}

            <div class="btnSet">
                <a href="{{ route('board.create') }}" class="btn large">등록하기</a>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style type="text/css">
        .t2d-flex {
            display: flex;
            align-items: flex-start;
            margin-top: 60px;
        }

        .t2d-flex > .tbl-basic {
            margin-right: 15px;
        }
    </style>
@endpush

@push('scripts')
    <script type="text/javascript">
        $(function() {
            // Selected sort display
            $('.sort').each(function() {
                let selectedField = $('#field').val(),
                    selectedSort = $('#sort').val(),
                    field = $(this).data('field');

                if (selectedField === field) {
                    $(this).addClass(selectedSort);
                }
            });

            // Sort click
            $('.sort').click(function() {
                let sort = 'asc',
                    field = $(this).data('field'),
                    url = '/board';

                if ($(this).hasClass('asc')) {
                    sort = 'desc';
                } else if ($(this).hasClass('desc')) {
                    sort = 'asc';
                }

                location.href = url + '?field=' + field + '&sort=' + sort;

                return false;
            });
        });
    </script>
@endpush
