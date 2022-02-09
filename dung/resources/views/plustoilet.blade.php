<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>급똥엔젤 - 화장실 추가하기</title>
    <link href="/css/styles1.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=9426lfdjn0&submodules=geocoder"><script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>

<body class="bg-white">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="card-header">
                                    <div id="return" onmouseover="bold" onclick="location.href='/'"></div>
                                    <h3 class="text-center font-weight-light my-4">
                                        <i class="fas fa-poo"></i>&nbsp화장실 등록하기</h3>
                                </div>
                    <div id="add-map">
                        <div class="center-marker"></div>
                    </div>
                    <script src="/js/add.js"></script>
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">

                                <div class="card-body">
                                    <form action="/plustoilet" method="POST">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="inputtoiletName" type="text"
                                                placeholder="inputtoiletName" />
                                            <label for="inputtoiletName">화장실 이름</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="inputaddress" type="text" placeholder="inputtoiletName" />
                                            <label for="inputaddress">주소</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="inputaddressDetail" type="text" placeholder="inputtoiletName" />
                                            <label for="inputaddressDetail">상세주소</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <label class="form-check-label" for="inputRememberPassword">화장지 있음</label>
                                            <input class="form-check-input" name="inputRememberPassword" type="checkbox"
                                                value="" />
                                        </div>
                                        <div class="form-check mb-3">
                                            <label class="form-check-label" for="inputRememberPassword">화장지 없음</label>
                                            <input class="form-check-input" name="inputRememberPassword" type="checkbox"
                                                value="" />
                                            <br>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="inputtoiletDetail" type="text"
                                                    placeholder="추가내용" />
                                                <label for="inputtoiletDetail">추가내용</label>
                                            </div>

                                        </div>
																				<div class="latlng">
                                            <input class="latlng" name="lat" type="text">
                                            <input class="latlng" name="lng" type="text">
                                        </div>
                                        <button type="submit" class="btn btn-dark" >확인</button>
                                </div>
                                </form>
                            </div>

                            <div class="card-footer text-center py-3">
                                <div class="small">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">X세대 &copy; 최현 최원석 임근웅 2022</div>
                </div>
            </div>
        </footer>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
</body>
</html>
