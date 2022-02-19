<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>급똥엔젤 - 회원가입</title>
    <link href="css/styles1.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous">
    </script>
</head>

<body class="bg-white">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                            <div class="card1 shadow-lg border-0 rounded-lg mt-5" style="background-color: whitesmoke;">
                                <div class="card-header">
                                    <div id="return"  onclick="location.href='/'"></div>
                                    <h3 class="text-center font-weight-light my-4">
                                        <i class="fas fa-poo"></i>&nbsp급똥엔젤
                                    </h3>
                                </div>


                                <div class="card-body">
                                    <form action="/joinmember" method="POST">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="inputName" type="text"
                                                placeholder="name" required/>
                                            <label for="inPutName">이름</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="inputEmail" type="email"
                                                placeholder="name@example.com" required />
                                            <label for="inputEmail">이메일</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="inputID" type="text" placeholder="id" required/>
                                            <label for="inputID">아이디</label>
                                        </div>
                                        @if ($duplicate = Session::get('Duplicate'))
                                        <div class="ID-DUPLI">
                                            {{ $duplicate }}
                                        </div>
                                        <BR>
                                        @endif
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="inputPassword" type="password"
                                                placeholder="Password" required />
                                            <label for="inputPassword">비밀번호</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="inputPasswordcheck" type="password"
                                                placeholder="Password" required />
                                            <label for="inputPasswordcheck">비밀번호 확인</label>
                                            <br></br>
                                            <button type="submit" class="btn btn-dark">확인</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="card-footer text-center py-3">
                                    <div class="small">
                                        <a href="login" style="color: black">로그인하기</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer" style="transform:translateY(200%); ">
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
