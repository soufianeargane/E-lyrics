<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <title>lyrics dashbord</title>

    <style>
        .second__color {
            background-color: #212529 !important;
            color: white;
        }

        .nav-link {
            color: #fff !important;
        }

        .tr-height {
            max-height: 55px !important;
            overflow-y: hidden;
        }

        .button__app {
            padding: 8px 25px;
            border-radius: 20px;
            background-color: #212529 !important;
            color: white;
            border: none;
        }

        .input__model {
            background-color: black;
            border: none;
            color: white;
        }

        .input__model:focus {
            background-color: black;
            border: 2px solid #212529;
            color: white;
        }

        @media(max-width: 768px) {
            .no-pp {
                padding-right: 0;
            }
        }
    </style>
</head>

<body class="">
    <div class="d-flex ">
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                        <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                            <span class="fs-5 d-none d-sm-inline"><?php if (isset($_SESSION['id'])) : ?>
                                    <?php echo $_SESSION['username'] ?>
                                <?php endif ?>
                            </span>
                        </a>
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                            <li class="nav-item">
                                <a href="./index.php" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi-house"></i><span class="ms-1 d-none d-sm-inline">Dashboard</span> </a>
                            </li>
                            <li>
                                <a href="./stats.php" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Stats</span></a>
                            </li>
                            <li>
                                <a href="./logout.php" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Logout</span> </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col py-3 no-pp">
                    <div class="d-flex justify-content-between flex-wrap align-items-center">
                        <div class="">
                            <button id="add_button" type="button" class="button__app" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="bi bi-plus-circle"></i>
                                Add
                            </button>
                        </div>
                        <div class="d-flex">
                            <div class="me-3">
                                <input type="text" id="search" class="form-control" onkeyup="tableSearch()" placeholder="search by song name">
                            </div>
                            <!-- Example single danger button -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Sort
                                </button>
                                <ul class="dropdown-menu">
                                    <li><button id="sort-name" class="dropdown-item">Singer name</button></li>
                                    <li><button id="sort-song" class="dropdown-item">Song name</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="w-100">
                        <div class="table-responsive">
                            <table id="table" class="mt-2 table second__color">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>singer</th>
                                        <th>song name</th>
                                        <th>lyrics</th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <tbody class="js-table-body">

                                </tbody>
                            </table>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content bg-dark">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-white" id="exampleModalLabel">Add Song </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <button id="add_inputs" class="btn btn-primary">
                                            <i class="bi bi-plus-circle"></i>
                                        </button>
                                        <button id="remove_inputs" class="btn btn-danger">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                        <div class="body">
                                            <div id="alert__" class=" alert-danger mt-2" role="alert">

                                            </div>
                                            <form action="" class="mt-2" id="form">

                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" id="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal UPDATE -->
                        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Song</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="body">
                                            <form action="" id="form">
                                                <div class="mt-2">
                                                    <label for="singer" class="form-label">singer</label>
                                                    <input type="text" class="form-control" id="singer_update" name="singer">
                                                </div>
                                                <div class="mt-2">
                                                    <label for="song_name" class="form-label">song name</label>
                                                    <input type="text" class="form-control" id="song_update" name="song_name">
                                                </div>
                                                <div class="mt-2">
                                                    <label for="lyrics" class="form-label">lyrics</label>
                                                    <textarea class="form-control" id="lyrics_update" name="lyrics" rows="3"></textarea>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" id="update" data-bs-dismiss="modal" class="btn btn-success">update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>


    <!-- js -->
    <script src="main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</body>

</html>