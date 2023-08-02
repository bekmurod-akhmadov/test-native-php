<?php
session_start();
require_once 'config.php';
require_once 'function.php';

$models = getScience();
if (!empty($_POST['count']) && !empty($_POST['fan'])){
    $count = $_POST['count'];
    $science = $_POST['fan'];
    if (!empty($count) && !empty($science)){
        $questions = queryByScience($science , $count);

    }

}else{
    $success = 0;
    $error = 0;
    $questionCount = count($_POST);
    $keys = array_keys($_POST);
    $answers = $_POST;
    foreach ($keys as $key){
       $item = getVariantById($key);

       if ($item[0]['is_correct'] ==1){
            $success = $success + 1;
       }else{
           $error = $error + 1;
       }
    }

//    echo "<p><strong>Jami savollar: </strong>$questionCount</p><p><strong>To'g'ri javoblar: </strong>$success</p><p><strong>Notog'ri javoblar: </strong>$error</p>";
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">Disabled</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
<div class="main">
    <div class="container">
        <div class="row  justify-content-center mt-5">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <?php if (empty($questions)): ?>
                        <form action="" method="post">
                            <label for="" class="d-block w-100 mb-4">
                                fanni tanlang
                                <select name="fan" id="" class="form-select ">
                                    <?php if (!empty($models)): ?>
                                        <?php foreach ($models as $model):?>
                                            <option value="<?=$model['id']?>"><?=$model['name']?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </label>
                            <label for="" class="w-100 mb-4">
                                savollarni soni
                                <select name="count" id="" class="form-select">
                                    <option value="3">3</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="15">20</option>
                                </select>
                            </label>
                            <button class="btn btn-primary">Boshlash</button>
                        </form>
                        <div class="table my-4">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Jami savollar</th>
                                        <th>To'g'ri javoblar</th>
                                        <th>Xato javoblar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?=$questionCount?></td>
                                        <td><?=$success?></td>
                                        <td><?=$error?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php else: ?>
                           <div class="group">
                               <h3 class="text-center m-3">Savollar</h3>
                               <form action="" method="post">
                                   <?php if (!empty($questions)): ?>
                                       <?php foreach ($questions as $key => $model): ?>
                                           <?php
                                           $answers = getAnswersByQuestion($model['id']);
                                           ?>
                                           <div class="question_item">
                                               <p style="border-top: 1px solid #ccc;padding: 10px 0;font-size: 20px;margin-bottom: 20px;" class="question"><?=$key+1?>.<?=$model['savol_matni']?></p>
                                               <div class="answer_group" style="display: flex;flex-direction: column">
                                                   <?php if ($answers): ?>
                                                       <?php foreach ($answers as $i => $answer): ?>
                                                           <label for="<?=$answer['id']?>" class="mb-2">
                                                               <input name="<?=$model['id']?>" id="<?=$answer['id']?>" type="radio" value="<?=!empty($answer['id']) ? $answer['id'] : ''?>">
                                                               <?=$i + 1?>. <?=$answer['title']?>
                                                           </label>

                                                       <?php endforeach; ?>
                                                   <?php endif; ?>
                                               </div>
                                           </div>
                                       <?php endforeach; ?>
                                   <?php endif; ?>
                                   <div class="btn_gr" style="border-top: 1px solid #ccc;margin:20px 0;padding-top: 20px;" >
                                       <button class="btn btn-primary">Testni topshirish</button>
                                   </div>
                               </form>
                           </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
