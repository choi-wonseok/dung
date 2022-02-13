<?
    include "dbinf.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <title>급똥엔젤</title>
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=9426lfdjn0">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="/js/motion.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/css/style.css" />
</head>

<body>
    <div class="loading">
        <img src="/image/ddong.jpg" alt="loading">
    </div>
    @foreach ($rows as $row)
    <div class="toilet" toiletName="{{ $row->toiletName }}" toiletNum="{{$row->toiletNum}}"
        toiletDetail="{{$row->toiletDetail}}" lat="{{$row->lat}}" lng="{{$row->lng}}" distance="{{$row->distance}}"></div>
    @endforeach
    <input type="checkbox" id="menuicon" />
    <div id="map"></div>
    <script src="/js/main.js"></script>
    <div id="search">
        <div class="header">
            <div class="menu_btn"><a href="#">
            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBkPSJNMjQgNmgtMjR2LTRoMjR2NHptMCA0aC0yNHY0aDI0di00em0wIDhoLTI0djRoMjR2LTR6Ii8+PC9zdmc+">
            </a>
            </div>
        </div>

        <a href="#a" id="serach1">@if (count($rows)) {{ $rows[0]->toiletName }} @endif</a>
        <a href="plustoilet" id="serach2"></a>
    </div>
    <div class="Tlist" onclick="showPopup(true)">목록보기</div>
    <div id="popup" class="hide">
        <div class="content">
            <div class="popup_header">목록보기</div>

            @foreach ($rows as $row)
            <div class="info">

                <a class="Tname" href="#"> {{ $row->toiletName }}</a>
                <p class="dis"><?php echo floor($row->distance*1000)
                    ?> m</span>


                <p>상세정보: {{$row->toiletDetail}}</p>

            </div>
            @endforeach
            <button class="more" id="more" >
                더보기
            </button>
            <button class="close" onclick="closePopup(true)">닫기</button>

        </div>
    </div>
    <div class="menu_bg"></div>
    <div id="sidebar_menu">
        <div class="close_btn"><a href="#">
            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBkPSJNMjMuOTU0IDIxLjAzbC05LjE4NC05LjA5NSA5LjA5Mi05LjE3NC0yLjgzMi0yLjgwNy05LjA5IDkuMTc5LTkuMTc2LTkuMDg4LTIuODEgMi44MSA5LjE4NiA5LjEwNS05LjA5NSA5LjE4NCAyLjgxIDIuODEgOS4xMTItOS4xOTIgOS4xOCA5LjF6Ii8+PC9zdmc+">
            </a>
        </div>
        <ul class="menu_wrap">
            <li><a href="/login">{{$uid ?? "로그인"}}</a></li>
            <li><a href="#">메뉴02</a></li>
            <li><a href="/about">about</a></li>
            <li>  @if ($uid != null)
                <a href="/logout">로그아웃</a>
                @endif</li>
        </ul>
    </div>
</body>

</html>
<?
    include "dbend.php";
?>
