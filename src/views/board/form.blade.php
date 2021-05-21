@extends('design::layouts.web')

@section('title', $title)

@section('content')
    <section id="write" class="container">
        <div class="page-title">{{ $title }}</div>


        <form id="boardForm" action="@if(isset($board)) {{ route('board.update', $board) }} @else {{ route('board.store') }} @endif" method="post">
            @csrf

            @if(isset($board))
                @method('PUT')
            @else
                @method('POST')
            @endif

            <div class="writeContents">
                <div class="wr-wrap line label200">
                    <div class="wr-list">
                        <div class="wr-list-label">제목</div>
                        <div class="wr-list-con">
                            <input type="text" id="title" name="title" value="{{ $board->title ?? '' }}" class="span" placeholder="제목">
                        </div>
                    </div>

                    <div class="wr-list">
                        <div class="wr-list-label">작성자</div>
                        <div class="wr-list-con">
                            <input type="text" id="author" name="author" value="{{ $board->author ?? '' }}" class="span" placeholder="작성자">
                        </div>
                    </div>

                    <div class="wr-list">
                        <div class="wr-list-label flex-start">내용</div>
                        <div class="wr-list-con">
                            <textarea id="content" name="content" class="autoSize" placeholder="내용">{{ $board->content ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="btnSet">
                    <a href="#" class="btn submit">확인</a>
                    <a href="#" class="btn gray btnCancel">취소</a>
                </div>
            </div>
        </form>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('.submit').click(function() {
                $('#boardForm').submit();

                return false;
            });

            $('.btnCancel').click(function() {
                history.back();

                return false;
            });
        });
    </script>
@endpush
