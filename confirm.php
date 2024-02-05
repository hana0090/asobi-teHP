<?php
session_start();
include('./PHPMailer.php');
include('./Exception.php');
include('./SMTP.php');

// 入力画面からのアクセスでなければ、戻す
if (!isset($_SESSION['form'])) {
    header('Location: index.php');
    exit();
} else {
    $post = $_SESSION['form'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // メールを送信する
    $to = 'hfmyoko@gmail.com';
    $from = $post['email'];
    $subject = 'お問い合わせが届きました';

    // 件名のエンコードを指定（文字化け対応）
    $subject = mb_encode_mimeheader($subject, 'UTF-8');

    //メール内容
    $body = <<<EOT
    名前： {$post['name']}
    メールアドレス： {$post['email']}
    お問い合わせ内容： {$post['inquiryType']}
    内容：
    {$post['remarks']}
    EOT;
    // PHPMailerの設定
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->SMTPDebug = 2; // デバッグ用
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = 'hfmyoko@gmail.com';
    $mail->Password = 'kmbt lgqf uwjw lejh';
    $mail->setFrom($from);
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->Body = $body;

    // 送信処理
    if (!$mail->Send()) {
        echo "送信失敗<br/ >";
        echo "エラー内容: " . $mail->ErrorInfo;
    } else {
        echo "送信成功";
    }

    // セッションを消してお礼画面へ
    unset($_SESSION['form']);
    header('Location: thanks.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お問合せフォーム</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="contact.css">
</head>
<body>
    <!-- お問合せフォーム画面 -->
    <div class="container">
        <form action="" method="POST">
            <p>お問い合わせ</p>
            <div class="form-group">
            <div class="row">
                <div class="col-3">
                    <label for="inputInquiryType">お問い合わせ内容</label>
                </div>
                <div class="col-9">
                    <p class="display_item"><?php echo htmlspecialchars($post['inquiryType']); ?></p>
                </div>
            </div>
        </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-3">
                        <label for="inputName">お名前</label>
                    </div>
                    <div class="col-9">
                        <p class="display_item"><?php echo htmlspecialchars($post['name']); ?></p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-3">
                        <label for="inputEmail">メールアドレス</label>
                    </div>
                    <div class="col-9">
                        <p class="display_item"><?php echo htmlspecialchars($post['email']); ?></p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-3">
                        <label for="inputContent">備考</label>
                    </div>
                    <div class="col-9">
                        <p class="display_item"><?php echo nl2br(htmlspecialchars($post['remarks'])); ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-9 offset-3">
                    <a href="index.php">戻る</a>
                    <button type="submit">送信する</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>