<?php
session_start();
$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    // フォームの送信時にエラーをチェックする
    if (!isset($post['inquiryType']) || empty($post['inquiryType'])) {
        $error['inquiryType'] = 'required';
    }

    if ($post['name'] === '') {
        $error['name'] = 'blank';
    }

    if ($post['email'] === '') {
        $error['email'] = 'blank';
    } else if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'email';
    }

    if ($post['remarks'] === '') {
        $error['remarks'] = 'blank';
    }

    // エラーがないので確認画面に移動
    if (count($error) === 0) {
        $_SESSION['form'] = $post;
        header('Location: confirm.php');
        exit();
    }
    //REQUEST_METHODが'POST'でない場合セッションに保存されたフォームデータを取得し再表示
} else {
    if (isset($_SESSION['form'])) {
        $post = $_SESSION['form'];
    }
}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="reset.css" />
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Sawarabi+Gothic&display=swap" />
  <title>Your NPO Website</title>
</head>
<body>
  <header class="header">
    <nav>
      <ul>
        <li><a href="#section-01">HELLO</a></li>
        <li><a href="#activity">ACTIVITY</a></li>
        <li><a href="#members">メンバー紹介</a></li>
        <li><a href="#sns">SNS更新中！</a></li>
        <li><a href="#schedule">スケジュール</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <div class="full-view-image"></div>
    <!-- HELLO Section -->
    <section class="lp_sec page_link section_pdg" id="section-01">
      <div class="inner">
        <h2 class="ttl-01 font-jp">ごあいさつ</h2>
        <div class="lp_parts flex">
          <div class="img-detail img-trim pos_rel">
            <img width="640" height="468" src="./img/aso3.jpg" class="img-contain native-lazyload-js-fallback" alt="メインイメージ" />
          </div>
          <div class="text content-body">
            <p>はじめまして。<br />
              asobi-teは宇治で活動する遊びのサークルです。<br />
              遊びのひろばの運営など、主にーーーを対象に子どもたちの「ーーー力」を育む活動に取り組んでいます。
            </p>
            <p>
              人生の壁にぶつかった時、悲しい選択肢をとるのではなく、自ら新しい道を切り拓ける人になってほしい…。<br />
              そんな想いから、子どもたちが自分で考え・行動できる力を育めるようサポートしています。
            </p>
            <p>ーーーーと思ったからこそ。<br />
              子どもたちの「ーーーー力」を育む活動に、これからも全力で取り組んでいきます。
            </p>
            <p>子どもたちが夢や希望を持ち、いきいきと活躍できるように。<br />
              子どもたちの明るい未来を応援していきます！
            </p>
          </div><!-- .text -->
        </div><!-- lp_parts flex -->
      </div><!-- .inner -->
    </section>
    <!-- HELLO Section おわり -->

    <!-- ACTIVITY Section -->
    <section class="lps_sec page_link section_pdg section_deco" id="section-02">
      <h2 class="ttl-01 inner font-jp" id="活動について">
        <span>活動について</span>
      </h2>
      <div class="lps_parts lps_parts--img_text" id="section_child_01-img_and_text_01">
        <div class="mce-content-body clearfix">
          <div style="text-align: center">
            お子さんの年齢や、お母さんお父さんの気になるものに合わせて様々な</br>
            お子さんの年齢や、お母さんお父さんの気になるものに合わせて様々な</br>
            お子さんの年齢や、お母さんお父さんの気になるものに合わせて様々な</br>
          </div>
          <div class="lps_parts inner flex">
            <div class="activity-item">
              <div class="activity-image">
                <img src="img/1.jpg" alt="Toy Image" />
              </div>
              <div class="activity-text">
                <p>おもちゃ<br />
                  お子さんの年齢や、お母さんお父さんの気になるものに合わせて様々なおもちゃを用意しています</p>
              </div>
            </div>
            <div class="activity-item">
              <div class="activity-image">
                <img src="img/2.jpg" alt="Toy Image" />
              </div>
              <div class="activity-text">
                <p>えほん<br />季節やお子さんの年齢に合わせたえほんを用意しています読み聞かせもしています</p>
              </div>
            </div>
            <div class="activity-item">
              <div class="activity-image">
                <img src="img/3.jpg" alt="Toy Image" />
              </div>
              <div class="activity-text">
                <p>造形<br />絵の具やクレヨン、折り紙などを使った工作や造形あそびで心をほっこりさせる時間を！</p>
              </div>
            </div>
            <div class="activity-item">
              <div class="activity-image">
                <img src="img/4.jpg" alt="Toy Image" />
              </div>
              <div class="activity-text">
                <p>ゲーム<br />子供から大人まで一緒になって楽しめるゲームがたくさん！リクエストも受付中！</p>
              </div>
            </div>
          </div><!-- .lps_parts inner flex -->
        </div>
      </div>

      <div style="text-align: center">
        <p>SNSで活動内容を配信中です！</p>
      </div>

      <div class="flex">
        <div class="btn">
          <a href="https://twitter.com/">Twitter</a>
        </div>
        <div class="btn">
          <a href="https://www.instagram.com/asobi_te/">Instagram</a>
        </div>
      </div><!-- .inner -->
    </div><!-- .lps_parts -->
  </section><!-- .lps_sec -->

  <!-- メンバー紹介 Section -->
  <section class="lp_sec page_link section_pdg" id="section-03">
    <div class="inner">
      <h2 class="ttl-01 font-jp" id="メンバー紹介">
        メンバー紹介
      </h2>
      <div class="member-content flex">
        <div class="member">
          <div class="member-image">
            <img src="img/hana.png" alt="Member 1" />
          </div>
          <div class="text">
            <p>はなさん</p><br />
            <p>おもちゃコンサルタント<br />おもちゃインストラクター</p>
          </div>
        </div><!-- member -->
        <div class="member">
          <div class="member-image">
            <img src="img/yuriko.png" alt="Member 2" />
          </div>
          <div class="text">
            <p>ゆみこさん</p><br />
            <p>おもちゃコンサルタント<br />おもちゃインストラクター</p>
          </div>
        </div><!-- member -->
        <div class="member">
          <div class="member-image">
            <img src="img/erina.png" alt="Member 3" />
          </div>
          <div class="text">
            <p>えりなさん</p><br />
            <p>おもちゃコンサルタント<br />おもちゃインストラクター</p>
          </div>
        </div>
      </div><!-- member-content -->
    </div>
  </section>

  <!-- スケジュール Section -->
  <section class="lp_sec page_link section_pdg">
    <div class="inner">
      <h2 class="ttl-01 font-jp">スケジュール</h2>
      <div style="text-align: center">
        <iframe src="https://calendar.google.com/calendar/embed?src=addressbook%23contacts%40group.v.calendar.google.com&ctz=Asia%2FTokyo" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
      </div>
    </div>
  </section>

  <!-- CONTACT FORM Section -->
  
  <section class="lp_sec_contact page_link section_pdg" id="section-06">
    <div class="inner">
      <h2 class="ttl-01 font-jp">お問い合わせ</h2>
      <div class="contact-form-inner">
      <form id="form" method="post" action=""  novalidate>
        <table>
          <tr>
            <th><label>お問い合わせ内容</label><span class="requiredIcon">必須</span></th>
            <td>
              <ul>
                <li>
                  <input type="radio" id="donation" name="inquiryType" value="寄付について" />
                  <label for="donation">活動について</label>
                </li>
                <li>
                  <input type="radio" id="interviewRequest" name="inquiryType" value="取材、講演の依頼" />
                  <label for="interviewRequest">取材、講演の依頼</label>
                </li>
                <li>
                  <input type="radio" id="other" name="inquiryType" value="その他" />
                  <label for="other">その他</label>
                </li>
              </ul>
              <?php if (isset($error['inquiryType']) && $error['inquiryType'] === 'required'): ?>
                <p class="error_msg">※お問い合わせ内容を選択してください</p>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <th><label>会社・団体名</label></th>
            <td><input type="text" name="companyName" /></td>
          </tr>
          <tr>
            <th><label>お名前</label><span class="requiredIcon">必須</span></th>
            <td>
              <input type="text" name="name" />
              <?php if (isset($error['name']) && $error['name'] === 'blank'): ?>
                <p class="error_msg">※お名前をご記入下さい</p>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <th><label>メールアドレス</label><span class="requiredIcon">必須</span></th>
            <td>
              <input type="email" name="email" />
              <?php if (isset($error['email']) && $error['email'] === 'blank'): ?>
                <p class="error_msg">※メールアドレスをご記入下さい</p>
              <?php elseif (isset($error['email']) && $error['email'] === 'email'): ?>
                <p class="error_msg">※メールアドレスを正しくご記入ください</p>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <th><label>備考</label></th>
            <td>
              <textarea name="remarks"></textarea>
              <?php if (isset($error['remarks']) && $error['remarks'] === 'blank'): ?>
                <p class="error_msg">※お問い合わせ内容をご記入下さい</p>
              <?php endif; ?>
            </td>
          </tr>
        </table>

        <div id="form_btn">
          <input type="submit" value="内容の確認" />
        </div>
      </form>


  <!-- ページ内リンク -->
  <?php if (isset($error['inquiryType']) || isset($error['fullName']) || isset($error['email']) || isset($error['remarks'])): ?>
    <script>
      document.location = '#section-06';  // エラーメッセージのセクションにジャンプ
    </script>
  <?php endif; ?>

      </div>
    </div>
  </section>
  <!-- CONTACT FORM Section おわり -->
</main>

<!-- footer -->
<footer class="bg-sub">
      <ul class="footer-menu">
        <li>home ｜</li>
        <li>about ｜</li>
        <li>service ｜</li>
        <li>Contact Us</li>
      </ul>
      <p>© All rights reserved by dmmwebcampmedia.</p>
    </footer>
  </body>
  </html>